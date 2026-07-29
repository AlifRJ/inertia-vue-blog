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
    laravelVersion: {
        type: String,
        required: true,
    },
    post: {
        type: Object,
        required: true,
    },
    category: {
        type: Object,
        required: true,
    },
    author: {
        type: Object,
        required: true,
    },
});

const formatDate = (dateValue) => {
    if (!dateValue) return "";
    const d = new Date(dateValue);

    // Extract and pad day and month
    const day = String(d.getDate()).padStart(2, "0");
    const month = String(d.getMonth() + 1).padStart(2, "0"); // Months are 0-indexed

    // Get last two digits of the year
    const year = String(d.getFullYear()).slice();

    return `${day}-${month}-${year}`;
};
const date = formatDate(props.post.created_at);
</script>
<template>
    <Head :title="post.slug" />
    <HomeLayout
        :canLogin="canLogin"
        :canRegister="canRegister"
        :laravelVersion="laravelVersion"
    >
        <!-- MAIN CONTAINER -->
        <main class="max-w-4xl mx-auto px-6 py-8 flex-grow w-full">
            <article
                class="bg-white p-8 md:p-12 rounded-xl shadow-sm border border-gray-100 mb-16"
            >
                <!-- Tombol Kembali -->
                <div class="mb-6">
                    <Link
                        class="inline-flex items-center gap-2 text-sm font-medium text-blue-600 hover:text-blue-700 transition"
                        :href="route('blog')"
                        ><i class="fa-solid fa-arrow-left"></i> Kembali ke
                        Daftar Artikel
                    </Link>
                </div>

                <!-- Header Artikel -->
                <header class="mb-8">
                    <span
                        class="inline-block text-xs font-medium text-blue-600 bg-blue-50 px-3 py-1 rounded-full mb-3"
                    >
                        <i class="fa-solid fa-code mr-1"></i>
                        {{ category.name }}
                    </span>
                    <h1
                        class="text-2xl md:text-4xl font-bold text-gray-900 leading-snug mb-4"
                    >
                        {{ post.title }}
                    </h1>
                    <div
                        class="flex flex-wrap gap-6 text-xs md:text-sm text-gray-500"
                    >
                        <span
                            ><i
                                class="fa-regular fa-calendar text-blue-600 mr-1.5"
                            ></i>
                            {{ date }}</span
                        >
                        <span
                            ><i
                                class="fa-regular fa-user text-blue-600 mr-1.5"
                            ></i>
                            {{ author.username }}</span
                        >
                    </div>
                </header>

                <!-- Thumbnail -->
                <div
                    class="h-64 md:h-96 bg-gray-100 rounded-xl flex items-center justify-center text-gray-400 text-5xl mb-10"
                >
                    <i class="fa-regular fa-image"></i>
                </div>

                <!-- Isi Artikel -->
                <div
                    class="text-gray-700 space-y-6 text-base md:text-lg leading-relaxed"
                >
                    <p class="font-medium text-gray-900 text-lg md:text-xl">
                        {{ post.body }}
                    </p>
                </div>
                <!-- Bagian Bagikan -->
                <footer
                    class="mt-12 pt-6 border-t border-gray-100 flex items-center gap-4 text-sm text-gray-600"
                >
                    <span class="font-medium">Bagikan artikel ini:</span>
                    <div class="flex gap-2">
                        <a
                            href="#"
                            class="w-9 h-9 bg-gray-100 hover:bg-blue-600 hover:text-white rounded-full flex items-center justify-center transition"
                            ><i class="fa-brands fa-facebook-f"></i
                        ></a>
                        <a
                            href="#"
                            class="w-9 h-9 bg-gray-100 hover:bg-blue-600 hover:text-white rounded-full flex items-center justify-center transition"
                            ><i class="fa-brands fa-x-twitter"></i
                        ></a>
                        <a
                            href="#"
                            class="w-9 h-9 bg-gray-100 hover:bg-blue-600 hover:text-white rounded-full flex items-center justify-center transition"
                            ><i class="fa-brands fa-whatsapp"></i
                        ></a>
                    </div>
                </footer>
            </article>
        </main>
    </HomeLayout>
</template>
