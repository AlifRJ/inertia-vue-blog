<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PostCategoryForm from "@/Components/PostCategoryForm.vue";

defineProps({
    categories: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Edit Post" />

        <PostCategoryForm :categories="categories" />
    </AuthenticatedLayout>
</template>
