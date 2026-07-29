<script setup></script>
<template>
    <!-- MAIN CONTAINER -->
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
                    Kategori: Teknologi
                </h2>
                <p class="text-sm text-gray-500">
                    Menampilkan semua artikel pilihan seputar pemrograman,
                    perkembangan software, dan tips dunia IT.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Item 1 -->
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
                            ><i class="fa-solid fa-code mr-1"></i>
                            Teknologi</span
                        >
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">
                            <a
                                href="post-detail.html"
                                class="hover:text-blue-600 transition"
                                >Cara Belajar Coding dari Nol untuk Pemula</a
                            >
                        </h4>
                        <p class="text-sm text-gray-600 mb-4 flex-grow">
                            Mulai perjalanan pemrograman Anda dengan panduan
                            langkah demi langkah yang mudah dipahami...
                        </p>
                    </div>
                </div>

                <!-- Item 2 -->
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
                            ><i class="fa-solid fa-code mr-1"></i>
                            Teknologi</span
                        >
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">
                            <a href="#" class="hover:text-blue-600 transition"
                                >Mengenal Dasar-Dasar Bahasa Pemrograman CSS
                                Modern</a
                            >
                        </h4>
                        <p class="text-sm text-gray-600 mb-4 flex-grow">
                            Pelajari fitur flexbox, grid, dan tata letak modern
                            agar tampilan website semakin memukau...
                        </p>
                    </div>
                </div>

                <!-- Item 3 -->
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
                            ><i class="fa-solid fa-code mr-1"></i>
                            Teknologi</span
                        >
                        <h4 class="text-lg font-semibold text-gray-900 mb-2">
                            <a href="#" class="hover:text-blue-600 transition"
                                >Tips Mengatasi Error Saat Ngoding untuk
                                Developer</a
                            >
                        </h4>
                        <p class="text-sm text-gray-600 mb-4 flex-grow">
                            Jangan panik! Simak cara cerdas membaca pesan error
                            dan mencari solusinya secara efektif...
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>
