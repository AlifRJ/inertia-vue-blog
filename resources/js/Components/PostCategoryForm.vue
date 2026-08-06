<script setup>
import InputError from "@/Components/InputError.vue";
import InputLabel from "@/Components/InputLabel.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
// import FileInput from "@/Components/FileInput.vue";
import RichTextarea from "./RichTextarea.vue";
import { Link, useForm } from "@inertiajs/vue3";
// import { computed, ref, watch } from "vue";
import { computed } from "vue";

// catch props
const props = defineProps({
    categories: {
        type: Object,
        default: null,
    },
});

// const fileInputRef = ref(null);
// const imagePreview = ref(null);

// Inertia useForm
const form = useForm({
    name: props.categories?.name ?? "",
    // image: props.categories?.image ?? null,
    detail: props.categories?.detail ?? "",
});

// Watch `form.image` to automatically create/revoke object previews when a new file is chosen via v-model
// watch(
//     () => form.image,
//     (newVal) => {
//         if (newVal instanceof File) {
//             if (imagePreview.value) {
//                 URL.revokeObjectURL(imagePreview.value);
//             }
//             imagePreview.value = URL.createObjectURL(newVal);
//         } else if (!newVal) {
//             clearPreview();
//         }
//     },
// );

// Clear the selected file and preview
// const clearAll = () => {
//     clearPreview();
//     form.image = null;
//     fileInputRef.value?.clear();
// };

// const clearPreview = () => {
//     if (imagePreview.value) {
//         URL.revokeObjectURL(imagePreview.value);
//         imagePreview.value = null;
//     }
// };

// Form Mode
const isEditMode = computed(() => props.categories !== null);

// Submit
const submit = () => {
    if (isEditMode.value) {
        form.put(route("category.update", props.categories.slug), {
            forceFormData: true,
            onSuccess: () => alert("Category updated successfully!"),
        });
    } else {
        form.post(route("category.store"), {
            onSuccess: () => form.reset(),
        });
    }
};
</script>

<template>
    <form
        @submit.prevent="submit"
        class="space-y-6 max-w-2xl mx-auto p-6 bg-white rounded-lg shadow"
        id="PostCategoryForm"
    >
        <!-- Name Input -->
        <div>
            <InputLabel for="name" value="Name" />
            <TextInput
                id="name"
                type="text"
                class="mt-1 block w-full"
                v-model="form.name"
                required
            />
            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <!-- Image Input -->
        <!-- <div> -->
        <!-- Show existing image if form.image is a string (path) -->
        <!-- <div
                v-if="
                    typeof form.image === 'string' &&
                    form.image &&
                    !imagePreview
                "
            >
                <img
                    :src="`/storage/${form.image}`"
                    class="w-128 h-64 object-cover rounded-md"
                />
            </div> -->
        <!-- Preview container (visible only when an image is selected) -->
        <!-- <div
                v-if="imagePreview"
                class="mt-2 mb-3 relative w-128 h-64 object-cover rounded-md border bg-gray-100"
            >
                <img
                    :src="imagePreview"
                    alt="Preview"
                    class="w-full h-full object-cover"
                />
            </div> -->

        <!-- <div>
                <InputLabel for="image" value="Image" />
                <div class="flex items-center gap-2 mt-1">
                    <FileInput
                        ref="fileInputRef"
                        @change="handleFileChange"
                        accept="image/*"
                        id="image"
                        type="file"
                        class="mt-1 block w-full"
                        v-model="form.image"
                    />
                    <button
                        v-if="form.image"
                        type="button"
                        @click="clearAll"
                        class="px-3 py-2 text-sm font-medium text-red-600 bg-red-50 border border-red-200 rounded-md hover:bg-red-100 focus:outline-none focus:ring-2 focus:ring-red-500 transition-colors"
                    >
                        Clear
                    </button>
                </div>
                <InputError class="mt-2" :message="form.errors.image" />
            </div> -->
        <!-- </div> -->

        <!-- Detail Textarea -->
        <div>
            <InputLabel for="detail" value="Detail Content" />
            <RichTextarea
                id="detail"
                class="mt-1 block w-full"
                v-model="form.detail"
            />
            <InputError class="mt-2" :message="form.errors.detail" />
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end mt-4 border-t pt-4 gap-3">
            <Link
                :href="route('category.index')"
                class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150"
            >
                Cancel
            </Link>

            <PrimaryButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                {{ isEditMode ? "Update Category" : "Create Category" }}
            </PrimaryButton>
        </div>
    </form>
</template>
