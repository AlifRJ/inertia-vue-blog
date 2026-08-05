<script setup>
const currentYear = new Date().getFullYear();
</script>
<template>
    <footer
        class="py-16 text-center text-sm border-gray-200 bg-gray-50 text-gray-600 border-t hover:text-blue-600"
    >
        <div>Laravel Inertia Blog by <strong>Alif Rahmat Julianda</strong></div>
        <div>Copyright &copy; {{ currentYear }}</div>
    </footer>
</template>
