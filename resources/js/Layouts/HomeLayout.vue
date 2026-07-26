<script setup>
import Header from "@/Components/Header.vue";
import Footer from "@/Components/Footer.vue";

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
    <Header :canLogin="canLogin" :canRegister="canRegister" />
    <div>
        <slot />
    </div>
    <Footer :laravelVersion="laravelVersion" />
</template>
