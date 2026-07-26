<script setup>
defineProps({
    laravelVersion: {
        type: String,
        required: true,
    },
});
const currentYear = new Date().getFullYear();
</script>
<template>
    <footer
        class="py-16 text-center text-sm border-gray-200 bg-gray-50 text-gray-600 border-t hover:text-blue-600"
    >
        <div>Copyright &copy; {{ currentYear }} Alif RJ</div>
        <div>Laravel v{{ laravelVersion }}, Inertiajs, Vue3, Tailwind</div>
    </footer>
</template>
