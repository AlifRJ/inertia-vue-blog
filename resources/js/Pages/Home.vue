<script setup>
import { Head, Link } from "@inertiajs/vue3";
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
    posts: {
        type: Object,
        required: true,
    },
    postCategories: {
        type: Object,
        required: true,
    },
});
</script>

<template>
    <Head title="Home" />
    <HomeLayout
        :canLogin="canLogin"
        :canRegister="canRegister"
        :laravelVersion="laravelVersion"
    >
        <main class="max-w-7xl mx-auto px-6 py-8 flex-grow w-full">
            <!-- CATEGORIES SECTION -->
            <section class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div v-for="category in postCategories">
                    <div
                        class="bg-white p-8 rounded-xl text-center border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-md transition duration-300 cursor-pointer flex flex-col items-center justify-center gap-3 h-40 group"
                    >
                        <div
                            class="w-12 h-12 bg-blue-50 text-blue-600 rounded-full flex items-center justify-center text-xl group-hover:bg-blue-600 group-hover:text-white transition duration-300"
                        >
                            <i class="fa-solid fa-laptop-code"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-800">
                            {{ category.name }}
                        </h3>
                    </div>
                </div>
            </section>

            <!-- LATEST POSTS SECTION -->
            <section class="mb-16">
                <h2
                    class="text-2xl font-bold mb-8 text-gray-900 flex items-center gap-2"
                >
                    <i class="fa-solid fa-fire text-blue-600"></i> Artikel
                    Terbaru
                </h2>
                <div
                    v-for="post in posts"
                    class="grid grid-cols-1 md:grid-cols-3 gap-8"
                >
                    <!-- Card -->
                    <div
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
                            >
                                <i class="fa-solid fa-code mr-1"></i>
                                {{ post.category?.name }}
                            </span>
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

                <div class="text-center mt-10">
                    <Link
                        class="inline-flex items-center gap-2 bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition group"
                        :href="route('blog')"
                    >
                        Lihat Artikel Lainnya
                        <i
                            class="fa-solid fa-arrow-right transition group-hover:translate-x-1"
                        ></i>
                    </Link>
                </div>
            </section>
        </main>
    </HomeLayout>
</template>
