<template>
    <div v-if="editor" class="m-2 tiptapBase">
        <tipbar :editor="editor" />
        <editor-content :editor="editor" class="tiptapEditorStyle" />

        <button v-show="showButton" class="button is-small ResDragBtn" @click="toggleResize">
            {{ isDraggable ? "Dragging" : "Resizing" }}
        </button>
    </div>
</template>

<script>
import { Editor, EditorContent } from "@tiptap/vue-2"
import CharacterCount from "@tiptap/extension-character-count"
import Highlight from "@tiptap/extension-highlight"
import StarterKit from "@tiptap/starter-kit"
import Placeholder from "@tiptap/extension-placeholder"
import Youtube from "@tiptap/extension-youtube"
import { Color } from "@tiptap/extension-color"
import TextStyle from "@tiptap/extension-text-style"
import TextAlign from "@tiptap/extension-text-align"
import ResizableImage from "./resizableImage/resizable-image"
import tipbar from "./tipbar.vue"

export default {
    components: { EditorContent, tipbar },
    props: {
        value: {
            type: String,
            default: ""
        }
    },
    data() {
        return {
            editor: null,
            extensions: [
                CharacterCount.configure({
                    limit: 10000
                }),
                Highlight,
                Color,
                TextStyle,
                TextAlign.configure({
                    types: ["heading", "paragraph", "image"]
                }),
                StarterKit.configure({
                    heading: {
                        levels: [1, 2, 3, 4, 5, 6]
                    }
                }),
                Placeholder.configure({
                    placeholder: "Write something…"
                }),
                ResizableImage.configure({
                    inline: true
                }),
                Youtube.configure({
                    inline: false,
                    width: 480,
                    height: 320
                    // allowFullscreen: false,
                    // ccLanguage: 'es',
                })
            ]
        }
    },
    computed: {
        showButton() {
            return this.editor?.state?.selection?.node?.type?.name === "ResizableImage"
        },
        isDraggable() {
            return this.editor?.state?.selection?.node?.attrs?.isDraggable
        }
    },
    watch: {
        value(value) {
            // HTML
            const isSame = this.editor.getHTML() === value

            // JSON
            // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)

            if (isSame) return

            this.editor.commands.setContent(value, false)
        }
    },
    beforeUnmount() {
        this.editor.destroy()
    },
    mounted() {
        this.editor = new Editor({
            content: this.value,
            editorProps: {
                attributes: {
                    class: "tiptapProse p-2"
                }
            },
            extensions: [...this.extensions],
            onUpdate: () => {
                // HTML
                this.$emit("input", this.editor.getHTML())

                // JSON
                // this.$emit('input', this.editor.getJSON())
            }
        })
    },
    methods: {
        toggleResize() {
            this.editor.chain().focus().toggleResizable().run()
        }
    }
}
</script>

<style scoped>
.tiptapBase {
    background-color: white;
    border-radius: 0.25rem; /* 4px */
    border: 1px solid #d9d9d9;
    min-height: 500px;
}

.tiptapProse {
    min-height: 100%;
    outline: 2px solid transparent;
    outline-offset: 2px;
}

.tiptapEditorStyle {
    height: 500px;
    overflow-y: auto;
    padding: 15px;
}

.ResDragBtn {
    position: absolute;
    bottom: 40px;
    left: 40px;
}

/* https://tiptap.dev/guide/styling/  */
.ProseMirror h1,
h2,
h3,
h4,
h5,
h6 {
    font-size: revert;
    font-weight: revert;
}

.ProseMirror ul,
ol {
    padding: revert;
    list-style: revert;
}

.ProseMirror blockquote {
    padding-left: 1rem;
    border-left: 3px solid rgba(13, 13, 13, 0.1);
    margin-left: revert;
}
</style>
