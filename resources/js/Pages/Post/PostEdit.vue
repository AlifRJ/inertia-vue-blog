<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PostForm from "@/Components/PostForm.vue";

defineProps({
    post: {
        type: Object,
        required: true,
    },
    categories: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Edit Post" />

        <PostForm :post="post" :categories="categories" />
    </AuthenticatedLayout>
</template>
