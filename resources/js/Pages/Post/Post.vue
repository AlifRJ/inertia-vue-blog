<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Searchbox from "@/Components/Searchbox.vue";
import { Head, Link, router, usePage } from "@inertiajs/vue3";
import { ref, computed, watch } from "vue";

// Catch props
const props = defineProps({
    posts: Object,
});

// Reactive state for client-side search and selection
const search = ref("");
const selectedPosts = ref([]);
const selectAll = ref(false);

// Toggle select all checkboxes
const toggleSelectAll = () => {
    if (selectAll.value) {
        selectedPosts.value = props.posts.data.map((p) => p.id);
    } else {
        selectedPosts.value = [];
    }
};

// Client-side search filtering (or trigger server-side reload)
// Client-side search filtering across title and excerpt
const filteredPosts = computed(() => {
    if (!props.posts?.data) return [];
    return props.posts.data.filter((post) => {
        return (
            post.title.toLowerCase().includes(search.value.toLowerCase()) ||
            post.excerpt?.toLowerCase().includes(search.value.toLowerCase())
        );
    });
});

const page = usePage();
const flashSuccess = computed(() => page.props.flash?.success);

watch(flashSuccess, (newVal) => {
    if (newVal) {
        setTimeout(() => {
            page.props.flash.success = null;
        }, 4000);
    }
});

// Delete single post
const deletePost = (slug) => {
    if (confirm("Are you sure you want to delete this post?")) {
        router.delete(route("post.destroy", slug), {
            preserveScroll: true,
        });
    }
};

// Bulk delete action
const bulkDelete = () => {
    if (confirm(`Delete ${selectedPosts.value.length} selected posts?`)) {
        router.post(
            route("post.bulk-destroy"),
            { ids: selectedPosts.value },
            {
                onSuccess: () => {
                    selectedPosts.value = [];
                    selectAll.value = false;
                },
                preserveScroll: true,
            },
        );
    }
};
</script>

<template>
    <Head title="My Post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                My Post
            </h2>
        </template>

        <div
            class="bg-white rounded-xl border border-gray-200 shadow-xs overflow-hidden"
        >
            <div
                v-if="flashSuccess"
                class="mb-4 p-4 text-sm text-green-700 bg-green-100 rounded-lg border border-green-200"
            >
                {{ flashSuccess }}
            </div>
            <!-- Table Header & Search Bar -->
            <div
                class="p-5 border-b border-gray-100 flex flex-col md:flex-row md:items-center md:justify-between gap-4"
            >
                <!-- Search Input -->
                <div class="relative flex-1 max-w-xs">
                    <span
                        class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400"
                    >
                        <i class="fa-solid fa-magnifying-glass text-xs"></i>
                    </span>
                    <Searchbox v-model="search" placeholder="Search post..." />
                </div>

                <!-- Header Actions -->
                <div class="flex items-center gap-3">
                    <!-- Bulk Delete -->
                    <button
                        v-if="selectedPosts.length > 0"
                        @click="bulkDelete"
                        class="px-3.5 py-2 text-sm font-medium text-red-600 bg-red-50 hover:bg-red-100 border border-red-200 rounded-lg transition flex items-center gap-1.5"
                    >
                        <i class="fa-solid fa-trash text-xs"></i>
                        Delete ({{ selectedPosts.length }})
                    </button>

                    <!-- New Post Link -->
                    <Link
                        :href="route('post.create')"
                        class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg transition shadow-xs flex items-center gap-2"
                    >
                        <i class="fa-solid fa-plus text-xs"></i>
                        New Post
                    </Link>
                </div>
            </div>

            <!-- Data Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <!-- Table Head -->
                    <thead>
                        <tr
                            class="bg-gray-50/75 border-b border-gray-100 text-xs font-semibold text-gray-500 uppercase tracking-wider"
                        >
                            <th class="p-4 w-10">
                                <input
                                    type="checkbox"
                                    v-model="selectAll"
                                    @change="toggleSelectAll"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                />
                            </th>
                            <th class="p-4">Post Title</th>
                            <th class="p-4">Category</th>
                            <th class="p-4">Status</th>
                            <th class="p-4">Created</th>
                            <th class="p-4 text-right">Actions</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody class="divide-y divide-gray-100 text-sm">
                        <tr
                            v-for="post in filteredPosts"
                            :key="post.id"
                            class="hover:bg-gray-50/50 transition duration-150"
                        >
                            <!-- Checkbox -->
                            <td class="p-4">
                                <input
                                    type="checkbox"
                                    :value="post.id"
                                    v-model="selectedPosts"
                                    class="rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                />
                            </td>

                            <!-- Title & Excerpt -->
                            <td class="p-4 max-w-xs">
                                <div
                                    class="font-semibold text-gray-900 truncate"
                                >
                                    {{ post.title }}
                                </div>
                                <div
                                    class="text-xs text-gray-500 truncate mt-0.5"
                                >
                                    {{ post.excerpt || "No excerpt provided" }}
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="p-4 whitespace-nowrap">
                                <span
                                    v-if="post.category?.name"
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100"
                                >
                                    {{ post.category.name }}
                                </span>
                                <span v-else class="text-gray-400 text-xs"
                                    >Uncategorized</span
                                >
                            </td>

                            <!-- Status -->
                            <td class="p-4 whitespace-nowrap">
                                <span
                                    class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium"
                                    :class="
                                        post.published
                                            ? 'bg-emerald-50 text-emerald-700 border border-emerald-200'
                                            : 'bg-amber-50 text-amber-700 border border-amber-200'
                                    "
                                >
                                    <span
                                        class="w-1.5 h-1.5 rounded-full"
                                        :class="
                                            post.published
                                                ? 'bg-emerald-500'
                                                : 'bg-amber-500'
                                        "
                                    ></span>
                                    {{ post.published ? "Published" : "Draft" }}
                                </span>
                            </td>

                            <!-- Date -->
                            <td
                                class="p-4 text-gray-500 whitespace-nowrap text-xs"
                            >
                                {{
                                    new Date(
                                        post.created_at,
                                    ).toLocaleDateString()
                                }}
                            </td>

                            <!-- Actions -->
                            <td class="p-4 text-right whitespace-nowrap">
                                <div class="inline-flex items-center gap-2">
                                    <Link
                                        :href="route('post.show', post.slug)"
                                        class="p-1.5 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100 transition"
                                        title="View Post"
                                    >
                                        <i class="fa-solid fa-eye"></i>
                                    </Link>

                                    <Link
                                        :href="route('post.edit', post.slug)"
                                        class="p-1.5 text-blue-600 hover:text-blue-800 rounded-lg hover:bg-blue-50 transition"
                                        title="Edit Post"
                                    >
                                        <i
                                            class="fa-solid fa-pen-to-square"
                                        ></i>
                                    </Link>

                                    <button
                                        @click="deletePost(post.slug)"
                                        class="p-1.5 text-red-500 hover:text-red-700 rounded-lg hover:bg-red-50 transition"
                                        title="Delete Post"
                                    >
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Empty State -->
                        <tr v-if="filteredPosts.length === 0">
                            <td
                                colspan="6"
                                class="p-8 text-center text-gray-500"
                            >
                                <div
                                    class="flex flex-col items-center justify-center"
                                >
                                    <i
                                        class="fa-solid fa-folder-open text-4xl text-gray-300 mb-2"
                                    ></i>
                                    <p class="text-base font-medium">
                                        No posts found
                                    </p>
                                    <p class="text-xs text-gray-400 mt-1">
                                        Try adjusting your search query.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination Controls -->
            <div
                v-if="posts?.links && posts.links.length > 3"
                class="p-4 border-t border-gray-100 flex items-center justify-between"
            >
                <p class="text-xs text-gray-500">
                    Showing
                    <span class="font-semibold">{{ posts.from }}</span> to
                    <span class="font-semibold">{{ posts.to }}</span> of
                    <span class="font-semibold">{{ posts.total }}</span>
                    entries
                </p>

                <div class="flex items-center space-x-1">
                    <template v-for="(link, index) in posts.links" :key="index">
                        <Link
                            v-if="link.url"
                            :href="link.url"
                            v-html="link.label"
                            class="px-3 py-1.5 text-xs font-medium rounded-md transition"
                            :class="[
                                link.active
                                    ? 'bg-blue-600 text-white'
                                    : 'bg-white text-gray-700 hover:bg-gray-100 border border-gray-200',
                            ]"
                            preserve-scroll
                        />
                        <span
                            v-else
                            v-html="link.label"
                            class="px-3 py-1.5 text-xs font-medium text-gray-400 bg-gray-50 border border-gray-100 rounded-md cursor-not-allowed"
                        />
                    </template>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
