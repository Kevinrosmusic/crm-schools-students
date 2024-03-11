<script setup>
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const students = ref([]);

const getStudents = () => {
    axios.get('/api/students')
        .then(response => students.value = response.data)
        .catch(error => console.log(error))
}

const deleteStudent = (id) => {
    Swal.fire({
        title: 'Are you sure you want to delete?',
        icon: 'warning',
        showCancelButton: true,
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete('/api/students/' + id)
                .then((response) => {
                    Swal.fire({
                      title: 'Student deleted!',
                      icon: 'success'
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/students';
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

onMounted(() => getStudents());
</script>

<template>
    <Head title="Students" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Students</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <a
                    href="/students/create"
                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                >
                    Add new student
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
                                                <td scope="col" class="px-6 py-4">Surnames</td>
                                                <td scope="col" class="px-6 py-4">Native city</td>
                                                <td scope="col" class="px-6 py-4">Birthdate</td>
                                                <td scope="col" class="px-6 py-4">School</td>
                                                <td>Actions</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <tr v-for="student in students" :key="student.id" class="border-b border-neutral-200 dark:border-white/10">
                                                <td class="px-6 py-4 font-medium">{{ student.id }}</td>
                                                <td class="px-6 py-4">{{ student.name }}</td>
                                                <td class="px-6 py-4">{{ student.surnames }}</td>
                                                <td class="px-6 py-4">{{ student.city }}</td>
                                                <td class="px-6 py-4">{{ student.birth_date }}</td>

                                                <td class="px-6 py-4">
                                                    <a :href="'/school/' + student.school.id" target="_blank">
                                                        {{ student.school?.name }}
                                                    </a>
                                                </td>

                                                <td nowrap class="px-6 py-4">
                                                    <a :href="'/students/' + student.id" class="mr-1 mt-1 text-white inline-flex bg-gray-500 rounded-md px-4 py-2">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a :href="'/students/' + student.id + '/edit'" class="mr-1 mt-1 text-white inline-flex bg-gray-500 rounded-md px-4 py-2">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <a href="#" @click.prevent="deleteStudent(student.id)" class="mt-1 text-white inline-flex bg-red-500 rounded-md px-4 py-2">
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
