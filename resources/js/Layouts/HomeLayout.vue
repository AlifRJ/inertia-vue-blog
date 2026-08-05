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
});
</script>

<template>
    <div>
        <Header :canLogin="canLogin" :canRegister="canRegister" />
        <div>
            <main class="min-h-screen mt-6 text-center">
                <slot />
            </main>
        </div>
        <Footer />
    </div>
</template>
