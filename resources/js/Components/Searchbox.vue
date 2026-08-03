<script setup>
const model = defineModel({
    type: String,
});
const props = defineProps({
    placeholder: {
        type: String,
    },
});
</script>

<template>
    <input
        v-model="model"
        type="text"
        :placeholder="placeholder"
        class="w-full pl-9 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
    />
</template>
