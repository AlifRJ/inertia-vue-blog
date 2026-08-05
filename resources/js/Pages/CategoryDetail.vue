<script setup>
import { Head, Link } from "@inertiajs/vue3";
import HomeLayout from "@/Layouts/HomeLayout.vue";
const props = defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    posts: {
        type: Object,
        required: true,
    },
    category: {
        type: Object,
        required: true,
    },
});
</script>
<template>
    <Head :title="category.name" />
    <!-- MAIN CONTAINER -->
    <HomeLayout :canLogin="canLogin" :canRegister="canRegister">
        <main class="max-w-7xl mx-auto px-6 py-8 flex-grow w-full">
            <!-- SEARCH BAR -->
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

            <!-- CATEGORY HEADER & ARTICLES SECTION -->
            <section class="mb-16">
                <div
                    class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 mb-8"
                >
                    <h2
                        class="text-2xl font-bold text-gray-900 flex items-center gap-2 mb-2"
                    >
                        <i class="fa-solid fa-laptop-code text-blue-600"></i>
                        Kategori: {{ category.name }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ category.detail }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Item 1 -->
                    <div
                        v-for="post in posts.data"
                        class="bg-white rounded-xl overflow-hidden shadow-sm hover:-translate-y-1 hover:shadow-md transition duration-300 border border-gray-100 flex flex-col"
                    >
                        <div
                            class="h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-4xl"
                        >
                            <i class="fa-regular fa-image"></i>
                        </div>
                        <div class="p-6 flex flex-col flex-grow">
                            <span
                                class="inline-block text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full mb-3 w-max"
                                ><i class="fa-solid fa-code mr-1"></i>
                                {{ post.category?.name }}</span
                            >
                            <h4
                                class="text-lg font-semibold text-gray-900 mb-2"
                            >
                                <Link
                                    class="hover:text-blue-600 transition"
                                    :href="route('blog.details', post.slug)"
                                    >{{ post.title }}
                                </Link>
                            </h4>
                            <p class="text-sm text-gray-600 mb-4 flex-grow">
                                {{ post.excerpt }}
                            </p>
                        </div>
                    </div>
                </div>

                <div
                    v-if="posts.links && posts.links.length > 3"
                    class="mt-10 flex items-center justify-center space-x-1"
                >
                    <template v-for="(link, index) in posts.links" :key="index">
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
