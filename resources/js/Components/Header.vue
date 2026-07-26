<script setup>
import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
});
const isMobileMenuOpen = ref(false);
</script>
<template>
    <header
        class="sticky top-0 z-50 w-full border-b border-gray-200 bg/80 backdrop-blur-md"
    >
        <nav v-if="canLogin" class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Sisi Kiri: Logo -->
                <div class="flex-shrink-0">
                    <a href="#" class="text-xl font-bold text-blue-600"
                        >My Blog</a
                    >
                </div>

                <!-- Sisi Tengah: Menu Desktop -->
                <div class="hidden md:flex space-x-8">
                    <Link :href="route('home')">
                        <a
                            class="text-sm font-medium active:text-gray-900 text-gray-500 hover:text-blue-600"
                            >Home</a
                        >
                    </Link>
                    <Link :href="route('about')">
                        <a
                            href="#"
                            class="text-sm font-medium active:text-gray-900 text-gray-500 hover:text-blue-600"
                            >About</a
                        >
                    </Link>
                    <Link :href="route('blog')">
                        <a
                            href="#"
                            class="text-sm font-medium active:text-gray-900 text-gray-500 hover:text-blue-600"
                            >Blog</a
                        >
                    </Link>
                </div>

                <!-- Sisi Kanan: Tombol Aksi Desktop -->
                <div class="hidden md:flex items-center space-x-4">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="rounded-md px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600"
                    >
                        Dashboard
                    </Link>

                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="rounded-md px-3 py-2 text-sm font-medium text-gray-500 hover:text-blue-600"
                        >
                            Log in
                        </Link>

                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition"
                        >
                            Register
                        </Link>
                    </template>
                </div>

                <!-- Tombol Hamburger Mobile -->
                <div class="flex md:hidden">
                    <button
                        @click="isMobileMenuOpen = !isMobileMenuOpen"
                        type="button"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-500 hover:bg-gray-100 hover:text-gray-700"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                        >
                            <!-- Ikan Hamburger berganti X saat terbuka -->
                            <path
                                v-if="!isMobileMenuOpen"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"
                            />
                            <path
                                v-else
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M6 18L18 6M6 6l12 12"
                            />
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Menu Panel Mobile -->
            <div
                v-show="isMobileMenuOpen"
                class="md:hidden border-t border-gray-100 py-3 space-y-3"
            >
                <a href="#" class="block text-base font-medium text-gray-900"
                    >Beranda</a
                >
                <a href="#" class="block text-base font-medium text-gray-500"
                    >About</a
                >
                <a href="#" class="block text-base font-medium text-gray-500"
                    >Blog</a
                >

                <div class="pt-4 border-t border-gray-200 space-y-2">
                    <Link
                        v-if="$page.props.auth.user"
                        :href="route('dashboard')"
                        class="block text-center text-base font-medium text-gray-700"
                    >
                        Dashboard
                    </Link>
                    <template v-else>
                        <Link
                            :href="route('login')"
                            class="block text-center text-base font-medium text-gray-500"
                        >
                            Log in
                        </Link>
                        <Link
                            v-if="canRegister"
                            :href="route('register')"
                            class="block text-center rounded-lg bg-blue-600 py-2 text-base font-medium text-white hover:bg-blue-700"
                        >
                            Register
                        </Link>
                    </template>
                </div>
            </div>
        </nav>
    </header>
</template>
