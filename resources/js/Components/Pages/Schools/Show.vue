<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, toRaw } from 'vue';

const school = ref([]);

const props = defineProps({
    id: {
        type: String
    }
});

const getSchool = () => {
    axios.get('/api/schools/' + props.id)
        .then(response => school.value = response.data)
        .catch(error => console.log(error))
}

onMounted(() => getSchool());
</script>

<template>
    <Head title="Schools" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Schools</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Show a school</h2>

                            <p class="mt-1 text-sm text-gray-600">From this form you can show a school.</p>
                        </header>

                        <form class="mt-6 space-y-6">
                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="name">
                                    <span>Name</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="name" type="text" required="" autofocus="" autocomplete="name" name="name" v-model="school.name">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="address">
                                    <span>Address</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="address" type="text" required="" autofocus="" autocomplete="address" name="address" v-model="school.address">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="email">
                                    <span>Email</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="email" type="email" required="" autofocus="" autocomplete="email" name="email" v-model="school.email">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="phone">
                                    <span>Phone</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="phone" type="text" required="" autofocus="" autocomplete="phone" name="phone" v-model="school.phone">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="web">
                                    <span>Website</span>
                                </label>

                                <input readonly class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="web" type="text" required="" autofocus="" autocomplete="web" name="web" v-model="school.web">
                            </div>

                            <div v-if="school.logo">
                                <label class="block font-medium text-sm text-gray-700" for="logo">
                                    <span>Logo</span>
                                </label>

                                <div>
                                    <img :src="'/storage/' + school.logo" :alt="school.name">
                                </div>
                            </div>

                            <div class="flex items-center gap-4">
                                <a href="/schools" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Back</a>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
