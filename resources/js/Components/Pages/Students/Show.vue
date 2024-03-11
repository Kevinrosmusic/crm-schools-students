<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, toRaw } from 'vue';

const student = ref([]);

const props = defineProps({
    id: {
        type: String
    }
});

const getStudent = () => {
    axios.get('/api/students/' + props.id)
        .then(response => student.value = response.data)
        .catch(error => console.log(error))
}

onMounted(() => getStudent());
</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Students</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Show a student</h2>

                            <p class="mt-1 text-sm text-gray-600">From this form you can show a student.</p>
                        </header>

                        <form class="mt-6 space-y-6">
                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="name">
                                    <span>Name</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="name" type="text" required="" autofocus="" autocomplete="name" name="name" v-model="student.name">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="surnames">
                                    <span>Surnames</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="surnames" type="text" required="" autofocus="" autocomplete="surnames" name="surnames" v-model="student.surnames">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="city">
                                    <span>Native city</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="city" type="text" required="" autofocus="" autocomplete="city" name="city" v-model="student.city">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="birth_date">
                                    <span>Birthdate</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="birth_date" type="date" required="" autofocus="" autocomplete="birth_date" name="birth_date" v-model="student.birth_date">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="school">
                                    <span>School</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="school" type="text" required="" autofocus="" autocomplete="school" name="school" :value="student.school?.name">
                            </div>

                            <div class="flex items-center gap-4">
                                <a href="/students" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
