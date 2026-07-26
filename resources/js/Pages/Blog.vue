<script setup>
import { Head } from "@inertiajs/vue3";
import HomeLayout from "@/Layouts/HomeLayout.vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Blogs" />
    <HomeLayout v-bind="$props">
        <main class="mt-6 text-center justify-center items-center">
            <h1>Blog Page</h1>
        </main>
    </HomeLayout>
</template>
