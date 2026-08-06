<script setup>
import { Link, Head } from "@inertiajs/vue3";
import HomeLayout from "@/Layouts/HomeLayout.vue";
const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    categories: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <Head title="Categories" />
    <HomeLayout :canLogin="canLogin" :canRegister="canRegister">
        <main class="max-w-7xl mx-auto px-6 py-8 flex-grow w-full">
            <!-- Search Bar -->
            <section class="mb-10">
                <form
                    class="flex flex-col sm:flex-row gap-3 max-w-2xl mx-auto"
                    action="#"
                    method="GET"
                >
                    <div class="relative flex-grow">
                        <i
                            class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"
                        ></i>
                        <input
                            type="text"
                            name="q"
                            placeholder="Cari artikel, topik, atau kata kunci..."
                            required
                            class="w-full pl-11 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 shadow-sm transition"
                        />
                    </div>
                    <button
                        type="submit"
                        class="bg-blue-600 text-white px-7 py-3 rounded-xl font-medium hover:bg-blue-700 transition"
                    >
                        Cari
                    </button>
                </form>
            </section>

            <!-- Category Card -->
            <section class="mb-16">
                <div
                    v-for="category in categories.data"
                    class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 mb-4 hover:cursor-pointer"
                >
                    <Link :href="route('category.details', category.slug)">
                        <h2
                            class="text-2xl font-bold text-gray-900 flex items-center gap-2 mb-2"
                        >
                            <i
                                class="fa-solid fa-laptop-code text-blue-600"
                            ></i>
                            Kategori: {{ category.name }}
                        </h2>
                        <p
                            v-html="category.detail"
                            class="text-sm text-gray-500"
                        ></p>
                    </Link>
                </div>

                <!-- Pagination -->
                <div
                    v-if="categories.links && categories.links.length > 3"
                    class="mt-10 flex items-center justify-center space-x-1"
                >
                    <template
                        v-for="(link, index) in categories.links"
                        :key="index"
                    >
                        <!-- Active / Clickable Link -->
                        <Link
                            v-if="link.url"
                            :href="link.url"
                            v-html="link.label"
                            class="px-3.5 py-2 text-sm font-medium rounded-lg transition border"
                            :class="[
                                link.active
                                    ? 'bg-blue-600 text-white border-blue-600'
                                    : 'bg-white text-gray-700 border-gray-200 hover:bg-gray-50',
                            ]"
                            preserve-scroll
                        />

                        <!-- Disabled State (First/Last page controls when inactive or '...') -->
                        <span
                            v-else
                            v-html="link.label"
                            class="px-3.5 py-2 text-sm font-medium text-gray-400 bg-gray-50 border border-gray-200 rounded-lg cursor-not-allowed"
                        />
                    </template>
                </div>
            </section>
        </main>
    </HomeLayout>
</template>
