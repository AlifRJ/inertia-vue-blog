<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import { Head } from "@inertiajs/vue3";
import { ref } from "vue";
defineProps({
    post: Object,
});
</script>

<template>
    <Head title="My Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                My Post
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 justify-center align-middle">
                        <h3>My Posts:</h3>
                        <table class="md:table-fixed border border-black">
                            <thead class="border border-black">
                                <tr>
                                    <th class="border border-black">Author</th>
                                    <th class="border border-black">Title</th>
                                    <th class="border border-black">Excerpt</th>
                                    <th class="border border-black">Body</th>
                                    <th class="border border-black">
                                        Published
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="data in post">
                                    <td class="border border-black">
                                        {{ data.user_id.name }}
                                    </td>
                                    <td class="border border-black">
                                        {{ data.title }}
                                    </td>
                                    <td class="border border-black">
                                        {{ data.excerpt }}
                                    </td>
                                    <td class="border border-black">
                                        {{ data.body }}
                                    </td>
                                    <td class="border border-black">
                                        {{ data.published_at }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
