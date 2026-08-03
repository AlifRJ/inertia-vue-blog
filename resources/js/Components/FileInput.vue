<script setup>
import { onMounted, ref } from "vue";

const model = defineModel({
    type: [Object, File, null],
});

const input = ref(null);

onMounted(() => {
    if (input.value && input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

// Fungsi pembantu jika user memilih file baru
const handleFileChange = (event) => {
    const files = event.target.files;
    if (files && files.length > 0) {
        model.value = files[0];
    } else {
        model.value = null;
    }
};

// Fungsi baru untuk menghapus/reset input file
const clearFile = () => {
    model.value = null;
    if (input.value) {
        input.value.value = ""; // Wajib: Reset nilai fisik DOM input file
    }
};

defineExpose({
    focus: () => input.value?.focus(),
    clear: clearFile, // Mengekspos fungsi clear agar bisa dipanggil dari parent component
});
</script>
<script>
export default {
    inheritAttrs: false,
};
</script>

<template>
    <input
        v-bind="$attrs"
        class="cursor-pointer rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
        @change="handleFileChange"
        ref="input"
    />
</template>
