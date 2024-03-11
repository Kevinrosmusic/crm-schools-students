<script setup>
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const schools = ref([]);

const getSchools = () => {
    axios.get('/api/schools')
        .then(response => schools.value = response.data)
        .catch(error => console.log(error))
}

const deleteSchool = (id) => {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        icon: 'warning',
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete('/api/schools/' + id)
                .then((response) => {
                    Swal.fire({
                      title: 'School deleted!',
                      icon: 'success'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/schools';
                        }
                    });
                })
                .catch((error) => {
                    Swal.fire({
                      title: 'Error!',
                      icon: 'success'
                    });

                    console.log(error);
                });
        }
    });
}

onMounted(() => getSchools());
</script>

<template>
    <Head title="Schools" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Schools</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a
                    href="/schools/create"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    Add new school
                </a>

                <div class="mt-3 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex flex-col">
                        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="inline-block w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-hidden">
                                    <table class="mt-4 mb-4 w-full text-left text-sm font-light text-surface dark:text-white">
                                        <thead class="border-b border-neutral-200 font-medium dark:border-white/10">
                                            <tr>
                                                <td scope="col" class="px-6 py-4">ID</td>
                                                <td scope="col" class="px-6 py-4">Name</td>
                                                <td scope="col" class="px-6 py-4">Address</td>
                                                <td scope="col" class="px-6 py-4">Logo</td>
                                                <td scope="col" class="px-6 py-4">Email</td>
                                                <td scope="col" class="px-6 py-4">Phone</td>
                                                <td scope="col" class="px-6 py-4">Web</td>
                                                <td>Actions</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="school in schools" :key="school.id" class="border-b border-neutral-200 dark:border-white/10">
                                                <td class="px-6 py-4 font-medium">{{ school.id }}</td>
                                                <td class="px-6 py-4">{{ school.name }}</td>
                                                <td class="px-6 py-4">{{ school.address }}</td>

                                                <td class="px-6 py-4">
                                                    <div v-if="school.logo">
                                                        <img :src="'/storage/' + school.logo" :alt="school.name">
                                                    </div>
                                                </td>

                                                <td class="px-6 py-4">{{ school.email }}</td>
                                                <td class="px-6 py-4">{{ school.phone }}</td>
                                                <td class="px-6 py-4">{{ school.web }}</td>

                                                <td nowrap class="px-6 py-4">
                                                    <a :href="'/schools/' + school.id" class="mr-1 mt-1 text-white inline-flex bg-gray-500 rounded-md px-4 py-2">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a :href="'/schools/' + school.id + '/edit'" class="mr-1 mt-1 text-white inline-flex bg-gray-500 rounded-md px-4 py-2">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a href="#" @click.prevent="deleteSchool(school.id)" class="mt-1 text-white inline-flex bg-red-500 rounded-md px-4 py-2">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
