<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted, toRaw } from 'vue';

const student = ref([]);
const errors = ref([]);

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

const schools = ref([]);

const getSchools = () => {
    axios.get('/api/schools')
        .then(response => schools.value = response.data)
        .catch(error => console.log(error))
}

const putStudent = () => {
    const form = student._rawValue;

    axios.put('/api/students/' + form.id, {
        name: form.name,
        surnames: form.surnames,
        city: form.city,
        birth_date: form.birth_date,
        school_id: form.school_id,
    })
    .then(response => {
        Swal.fire({
          title: 'Student updated!',
          icon: 'success'
        })
        .then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/students';
            }
        });
    })
    .catch(error => {
        if (error.response.status == 422) {
            errors.value = error.response.data.errors;
        }
    });
}

onMounted(() => {
    getSchools();
    getStudent();
});
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
                            <h2 class="text-lg font-medium text-gray-900">Edit a student</h2>

                            <p class="mt-1 text-sm text-gray-600">From this form you can edit a student.</p>
                        </header>

                        <form @submit.prevent="putStudent" class="mt-6 space-y-6">
                            <input type="hidden" id="id" name="id" v-model="student.id">

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="name">
                                    <span>Name</span>
                                </label>

                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="name" type="text" autofocus="" autocomplete="name" name="name" v-model="student.name">

                                 <span class="text-red-600" v-if="errors?.name">{{ errors.name[0] }}</span>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="surnames">
                                    <span>Surnames</span>
                                </label>

                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="surnames" type="text" autofocus="" autocomplete="surnames" name="surnames" v-model="student.surnames">

                                 <span class="text-red-600" v-if="errors?.surnames">{{ errors.surnames[0] }}</span>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="city">
                                    <span>Native city</span>
                                </label>

                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="city" type="text" autofocus="" autocomplete="city" name="city" v-model="student.city">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="birth_date">
                                    <span>Birthdate</span>
                                </label>

                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="birth_date" type="date" autofocus="" autocomplete="birth_date" name="birth_date" v-model="student.birth_date">

                                 <span class="text-red-600" v-if="errors?.birth_date">{{ errors.birth_date[0] }}</span>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="school">
                                    <span>School</span>
                                </label>

                                <select name="school_id" id="school_id" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full">
                                    <option value=""></option>
                                    <option v-for="school in schools" :key="school.id" :value="school.id" :selected="school.id == student.school?.id">{{ school.name }}</option>
                                </select>
                            </div>

                            <div class="flex items-center gap-4">
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Save</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
