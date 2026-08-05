<script setup>
import { Head } from "@inertiajs/vue3";
import HomeLayout from "@/Layouts/HomeLayout.vue";

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
    <Head title="About" />
    <HomeLayout :canLogin="canLogin" :canRegister="canRegister">
        <main class="max-w-7xl mx-auto px-6 py-8 flex-grow w-full">
            <section class="mb-16">
                <h2
                    class="text-2xl font-bold mb-8 text-gray-900 flex items-center gap-2"
                >
                    <i class="fa-solid fa-user text-blue-600"></i> Tentang
                    MyBlog
                </h2>
                <div
                    class="bg-white p-8 md:p-10 rounded-xl shadow-sm border border-gray-100"
                >
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">
                        Mengenal Lebih Dekat Platform Kami
                    </h3>
                    <p class="text-gray-600 text-base leading-relaxed mb-6">
                        <strong>MyBlog</strong> adalah platform digital
                        terpercaya yang didirikan untuk berbagi cerita, tutorial
                        pemrograman mendalam, informasi teknologi terkini, serta
                        tips gaya hidup dan edukasi bermutu tinggi bagi pembaca
                        di seluruh Indonesia.
                    </p>
                    <p class="text-gray-600 text-base leading-relaxed mb-8">
                        Kami percaya bahwa akses terhadap informasi dan
                        pengetahuan yang berkualitas harus terbuka bagi siapa
                        saja. Oleh karena itu, setiap artikel dirancang secara
                        cermat, mudah dipahami, dan relevan dengan perkembangan
                        zaman.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">
                        <div
                            class="bg-gray-50 p-6 rounded-xl text-center border border-gray-100"
                        >
                            <i
                                class="fa-solid fa-users text-3xl text-blue-600 mb-3"
                            ></i>
                            <h4
                                class="text-lg font-semibold text-gray-900 mb-1"
                            >
                                Komunitas Aktif
                            </h4>
                            <p class="text-sm text-gray-500">
                                Ribuan pembaca setia setiap bulannya.
                            </p>
                        </div>
                        <div
                            class="bg-gray-50 p-6 rounded-xl text-center border border-gray-100"
                        >
                            <i
                                class="fa-solid fa-pen-nib text-3xl text-blue-600 mb-3"
                            ></i>
                            <h4
                                class="text-lg font-semibold text-gray-900 mb-1"
                            >
                                Artikel Berkualitas
                            </h4>
                            <p class="text-sm text-gray-500">
                                Konten orisinal dan terkurasi dengan baik.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- BAGIAN KONTAK / HUBUNGI KAMI -->
            <section class="mt-12 pt-12 border-t border-gray-100">
                <h3
                    class="text-xl font-semibold text-gray-900 mb-4 flex items-center gap-2"
                >
                    <i class="fa-solid fa-envelope text-blue-600"></i> Hubungi
                    Kami
                </h3>

                <div
                    class="bg-white p-8 md:p-10 rounded-xl shadow-sm border border-gray-100"
                >
                    <p class="text-gray-600 text-base mb-6">
                        <strong
                            >Punya pertanyaan, kritik, saran, atau ingin
                            berkolaborasi?</strong
                        >
                        Jangan ragu untuk mengirimkan pesan melalui formulir di
                        bawah ini.
                    </p>

                    <form action="#" method="POST" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Nama Lengkap</label
                                >
                                <input
                                    type="text"
                                    placeholder="Masukkan nama Anda"
                                    required
                                    class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 shadow-sm transition"
                                />
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-medium text-gray-700 mb-1"
                                    >Alamat Email</label
                                >
                                <input
                                    type="email"
                                    placeholder="nama@email.com"
                                    required
                                    class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 shadow-sm transition"
                                />
                            </div>
                        </div>
                        <div>
                            <label
                                class="block text-sm font-medium text-gray-700 mb-1"
                                >Pesan</label
                            >
                            <textarea
                                rows="4"
                                placeholder="Tuliskan pesan Anda di sini..."
                                required
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:outline-none focus:border-blue-600 focus:ring-2 focus:ring-blue-100 shadow-sm transition"
                            ></textarea>
                        </div>
                        <button
                            type="submit"
                            class="bg-blue-600 text-white px-7 py-3 rounded-xl font-medium hover:bg-blue-700 transition flex items-center gap-2"
                        >
                            <i class="fa-solid fa-paper-plane"></i> Kirim Pesan
                        </button>
                    </form>
                </div>
            </section>
        </main>
    </HomeLayout>
</template>
