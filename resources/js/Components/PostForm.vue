<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import RichTextarea from "./RichTextarea.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { computed } from "vue";

// catch props
const props = defineProps({
    post: {
        type: Object,
        default: null,
    },
    categories: {
        type: Array,
        default: () => [],
    },
});

// Form Mode
const isEditMode = computed(() => props.post !== null);

// Inertia useForm
const form = useForm({
    category_id: props.post?.category_id ?? "",
    title: props.post?.title ?? "",
    body: props.post?.body ?? "",
    published: props.post?.published ? true : false, // Memastikan bertipe boolean
});

// Submit
const submit = () => {
    if (isEditMode.value) {
        form.put(route("post.update", props.post.slug), {
            onSuccess: () => alert("Post updated successfully!"),
        });
    } else {
        form.post(route("post.store"), {
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <form
        @submit.prevent="submit"
        class="space-y-6 max-w-2xl mx-auto p-6 bg-white rounded-lg shadow"
        id="PostForm"
    >
        <!-- Input Category -->
        <div>
            <InputLabel for="category_id" value="Category" />
            <select
                id="category_id"
                v-model="form.category_id"
                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                required
            >
                <option value="" disabled>Select a category</option>
                <option
                    v-for="category in categories"
                    :key="category.id"
                    :value="category.id"
                >
                    {{ category.name }}
                </option>
            </select>
            <InputError class="mt-2" :message="form.errors.category_id" />
        </div>

        <!-- Title Input -->
        <div>
            <InputLabel for="title" value="Title" />
            <TextInput
                id="title"
                type="text"
                class="mt-1 block w-full"
                v-model="form.title"
                required
            />
            <InputError class="mt-2" :message="form.errors.title" />
        </div>

        <!-- Body Textarea -->
        <div>
            <InputLabel for="body" value="Body Content" />
            <RichTextarea
                id="body"
                class="mt-1 block w-full"
                v-model="form.body"
            />
            <InputError class="mt-2" :message="form.errors.body" />
        </div>

        <!-- Published Status-->
        <div class="block">
            <label class="flex items-center">
                <input
                    type="checkbox"
                    v-model="form.published"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                />
                <span class="ms-2 text-sm text-gray-600"
                    >Publish immediately</span
                >
            </label>
            <InputError class="mt-2" :message="form.errors.published" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4 border-t pt-4 gap-3">
            <Link
                :href="route('post.index')"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
            >
                Cancel
            </Link>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                {{
                    isEditMode
                        ? "Update Post"
                        : form.published
                          ? "Publish Post"
                          : "Save Draft"
                }}
            </PrimaryButton>
        </div>
    </form>
</template>
