<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PostForm from "@/Components/PostForm.vue";

defineProps({
    categories: {
        type: Array,
        default: () => [],
    },
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create Post" />

        <PostForm :categories="categories" />
    </AuthenticatedLayout>
</template>
