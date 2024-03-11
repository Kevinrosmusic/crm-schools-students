<script setup>
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const schools = ref([]);
const errors = ref([]);

const postSchool = () => {
    const data = document.querySelector('#form');
    const fdata = new FormData(data);

    axios.post('/api/schools', fdata, {
            headers: {
              'Content-Type': 'multipart/form-data',
            }
        })
        .then(response => {
            Swal.fire({
              title: 'School created!',
              icon: 'success'
            })
            .then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/schools';
                }
            });
        })
        .catch(error => {
            console.log(error);

            if (error.response.status == 422) {
                errors.value = error.response.data.errors;
            }
        });
}
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
                            <h2 class="text-lg font-medium text-gray-900">Add new school</h2>

                            <p class="mt-1 text-sm text-gray-600">From this form you can create a new school.</p>
                        </header>

                        <form @submit.prevent="postSchool" id="form" class="mt-6 space-y-6">
                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="name">
                                    <span>Name</span>
                                </label>

                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="name" type="text" autofocus="" autocomplete="name" name="name">

                                <span class="text-red-600" v-if="errors?.name">{{ errors.name[0] }}</span>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="address">
                                    <span>Address</span>
                                </label>

                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="address" type="text" autofocus="" autocomplete="address" name="address">

                                <span class="text-red-600" v-if="errors?.address">{{ errors.address[0] }}</span>
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="email">
                                    <span>Email</span>
                                </label>

                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="email" type="email" autofocus="" autocomplete="email" name="email">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="phone">
                                    <span>Phone</span>
                                </label>

                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="phone" type="text" autofocus="" autocomplete="phone" name="phone">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="web">
                                    <span>Website</span>
                                </label>

                                <input class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full" id="web" type="text" autofocus="" autocomplete="web" name="web">
                            </div>

                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="logo">
                                    <span>Logo</span>
                                </label>

                                <span class="text-red-600" v-if="errors?.logo">{{ errors.logo[0] }}</span>

                                <input id="logo" type="file" name="logo">
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
