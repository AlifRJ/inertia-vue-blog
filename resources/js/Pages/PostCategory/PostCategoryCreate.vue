<script setup>
import { Head } from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import PostCategoryForm from "@/Components/PostCategoryForm.vue";
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Create Post" />

        <PostCategoryForm />
    </AuthenticatedLayout>
</template>
