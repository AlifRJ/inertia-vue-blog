<script setup>
import { useEditor, EditorContent } from "@tiptap/vue-3";
import StarterKit from "@tiptap/starter-kit";
import { watch } from "vue";

const props = defineProps({
    modelValue: { type: String, default: "" },
});

const emit = defineEmits(["update:modelValue"]);

const editor = useEditor({
    content: props.modelValue,
    extensions: [StarterKit],
    // Sync editor content back to parent form on update
    onUpdate: ({ editor }) => {
        emit("update:modelValue", editor.getHTML());
    },
});

// Sync parent changes (e.g., form reset) back down to the editor
watch(
    () => props.modelValue,
    (newValue) => {
        if (editor.value && editor.value.getHTML() !== newValue) {
            editor.value.commands.setContent(newValue, false);
        }
    },
);
</script>

<template>
    <div class="border rounded-md p-2 bg-white">
        <!-- Quick Toolbar (Style with your framework, e.g., Tailwind) -->
        <div v-if="editor" class="flex gap-2 border-b pb-2 mb-2 menu-bar">
            <button
                type="button"
                @click="editor.chain().focus().toggleBold().run()"
                :class="{ 'font-bold text-blue-500': editor.isActive('bold') }"
            >
                Bold
            </button>
            <button
                type="button"
                @click="editor.chain().focus().toggleItalic().run()"
                :class="{ 'italic text-blue-500': editor.isActive('italic') }"
            >
                Italic
            </button>
        </div>

        <!-- The actual text area area -->
        <editor-content
            :editor="editor"
            class="prose max-w-none focus:outline-none min-h-[150px]"
        />
    </div>
</template>
