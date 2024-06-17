<template>
    <div class="tipbar_zone">
        <div class="is-flex is-justify-content-start is-flex-wrap-wrap is-align-content-center pt-2 pl-2 pr-2 pb-1">
            <template v-for="(item, index) in items">
                <div v-if="item.type == 'divider'" :key="`divider${index}`" class="editorDivider ml-2 mr-2"></div>

                <tipitem v-else :key="index" class="m-1" v-bind="item" />
            </template>
        </div>

        <div
            class="is-flex is-justify-content-start is-flex-wrap-wrap is-align-content-center pt-1 pb-2 pl-3 pr-2 editorBorderBottom">
            <tipsheadings :items="headings" />

            <input
                class="input editorColorInput m-1 ml-2"
                type="color"
                :value="editor.getAttributes('textStyle').color"
                @input="editor.chain().focus().setColor($event.target.value).run()" />

            <template v-for="(item, index) in items2">
                <div v-if="item.type == 'divider'" :key="`divider${index}`" class="editorDivider ml-2 mr-2"></div>

                <tipitem v-else :key="index" class="m-1" v-bind="item" />
            </template>
        </div>

        <b-modal
            v-model="uploadImageModal"
            has-modal-card
            trap-focus
            :destroy-on-hide="false"
            aria-role="dialog"
            aria-label="Upload Image"
            close-button-aria-label="Close"
            aria-modal
            :width="768"
            :full-screen="false">
            <template #default="props">
                <uploadmodal v-if="uploadImageModal" @uploaded="imageUploaded" @close="props.close" />
            </template>
        </b-modal>
    </div>
</template>

<script>
import tipitem from "./tipitem.vue"
import tipsheadings from "./tipsheadings.vue"
import uploadmodal from "./uploadmodal.vue"

export default {
    components: { tipitem, tipsheadings, uploadmodal },
    props: {
        editor: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            headings: [
                {
                    icon: "paragraph",
                    title: "Párrafo",
                    action: () => this.editor.chain().focus().setParagraph().run(),
                    isActive: () => this.editor.isActive("paragraph")
                },
                {
                    icon: "h-1",
                    title: "Título" + " 1",
                    action: () => this.editor.chain().focus().toggleHeading({ level: 1 }).run(),
                    isActive: () => this.editor.isActive("heading", { level: 1 })
                },
                {
                    icon: "h-2",
                    title: "Título" + " 2",
                    action: () => this.editor.chain().focus().toggleHeading({ level: 2 }).run(),
                    isActive: () => this.editor.isActive("heading", { level: 2 })
                },
                {
                    icon: "h-3",
                    title: "Título" + " 3",
                    action: () => this.editor.chain().focus().toggleHeading({ level: 3 }).run(),
                    isActive: () => this.editor.isActive("heading", { level: 3 })
                },
                {
                    icon: "h-4",
                    title: "Título" + " 4",
                    action: () => this.editor.chain().focus().toggleHeading({ level: 4 }).run(),
                    isActive: () => this.editor.isActive("heading", { level: 4 })
                },
                {
                    icon: "h-5",
                    title: "Título" + " 5",
                    action: () => this.editor.chain().focus().toggleHeading({ level: 5 }).run(),
                    isActive: () => this.editor.isActive("heading", { level: 5 })
                },
                {
                    icon: "h-6",
                    title: "Título" + " 6",
                    action: () => this.editor.chain().focus().toggleHeading({ level: 6 }).run(),
                    isActive: () => this.editor.isActive("heading", { level: 6 })
                }
            ],
            items: [
                {
                    icon: "arrow-go-back-line",
                    title: "Deshacer",
                    action: () => this.editor.chain().focus().undo().run()
                },
                {
                    icon: "arrow-go-forward-line",
                    title: "Rehacer",
                    action: () => this.editor.chain().focus().redo().run()
                },
                { type: "divider" },
                {
                    icon: "bold",
                    title: "Negrita",
                    action: () => this.editor.chain().focus().toggleBold().run(),
                    isActive: () => this.editor.isActive("bold")
                },
                {
                    icon: "italic",
                    title: "Itálica",
                    action: () => this.editor.chain().focus().toggleItalic().run(),
                    isActive: () => this.editor.isActive("italic")
                },
                {
                    icon: "strikethrough",
                    title: "Tachado",
                    action: () => this.editor.chain().focus().toggleStrike().run(),
                    isActive: () => this.editor.isActive("strike")
                },
                {
                    icon: "code-view",
                    title: "Vista de código",
                    action: () => this.editor.chain().focus().toggleCode().run(),
                    isActive: () => this.editor.isActive("code")
                },
                {
                    icon: "mark-pen-line",
                    title: "Destacar",
                    action: () => this.editor.chain().focus().toggleHighlight().run(),
                    isActive: () => this.editor.isActive("highlight")
                },
                { type: "divider" },
                {
                    icon: "align-left",
                    title: "Alinear a la izquierda",
                    action: () => this.editor.chain().focus().setTextAlign("left").run(),
                    isActive: () => this.editor.isActive({ textAlign: "left" })
                },
                {
                    icon: "align-center",
                    title: "Alinear al centro",
                    action: () => this.editor.chain().focus().setTextAlign("center").run(),
                    isActive: () => this.editor.isActive({ textAlign: "center" })
                },
                {
                    icon: "align-right",
                    title: "Alinear a la derecha",
                    action: () => this.editor.chain().focus().setTextAlign("right").run(),
                    isActive: () => this.editor.isActive({ textAlign: "right" })
                },
                {
                    icon: "align-justify",
                    title: "Justificar",
                    action: () => this.editor.chain().focus().setTextAlign("justify").run(),
                    isActive: () => this.editor.isActive({ textAlign: "justify" })
                },
                { type: "divider" },
                {
                    icon: "paragraph",
                    title: "Párrafo",
                    action: () => this.editor.chain().focus().setParagraph().run(),
                    isActive: () => this.editor.isActive("paragraph")
                },
                {
                    icon: "list-unordered",
                    title: "Lista de viñetas",
                    action: () => this.editor.chain().focus().toggleBulletList().run(),
                    isActive: () => this.editor.isActive("bulletList")
                },
                {
                    icon: "list-ordered",
                    title: "Lista numerada",
                    action: () => this.editor.chain().focus().toggleOrderedList().run(),
                    isActive: () => this.editor.isActive("orderedList")
                },
                {
                    icon: "code-box-line",
                    title: "Bloque de código",
                    action: () => this.editor.chain().focus().toggleCodeBlock().run(),
                    isActive: () => this.editor.isActive("codeBlock")
                },
                { type: "divider" },
                {
                    icon: "text-wrap",
                    title: "Salto linea",
                    action: () => this.editor.chain().focus().setHardBreak().run()
                },
                {
                    icon: "format-clear",
                    title: "Formato claro",
                    action: () => this.editor.chain().focus().clearNodes().unsetAllMarks().run()
                }
            ],
            items2: [
                { type: "divider" },
                {
                    icon: "double-quotes-l",
                    title: "Cita en bloque",
                    action: () => this.editor.chain().focus().toggleBlockquote().run(),
                    isActive: () => this.editor.isActive("blockquote")
                },
                {
                    icon: "separator",
                    title: "Regla horizontal",
                    action: () => this.editor.chain().focus().setHorizontalRule().run()
                },
                { type: "divider" },
                {
                    icon: "youtube-line",
                    title: "Youtube",
                    action: () => {
                        const url = prompt("Enter YouTube URL")

                        if (url == null || url == "") {
                            return false
                        }

                        this.editor
                            .chain()
                            .focus()
                            .setYoutubeVideo({
                                src: url,
                                width: Math.max(320, parseInt(this.width, 10)) || 640,
                                height: Math.max(180, parseInt(this.height, 10)) || 480
                            })
                            .run()
                    }
                },
                {
                    icon: "image-line",
                    title: "Insertar imagen",
                    action: () => {
                        const url = prompt("Enter Image URL")

                        if (url) this.editor.chain().focus().setImage({ src: url }).run()
                    }
                },
                {
                    icon: "image-add-line",
                    title: "Cargar imagen",
                    action: () => (this.uploadImageModal = true)
                }
            ],
            uploadImageModal: false
        }
    },
    methods: {
        imageUploaded(url_path) {
            this.editor.chain().focus().setImage({ src: url_path }).run()
        }
    }
}
</script>

<style scoped>
.editorBorderBottom {
    border-bottom-color: #d9d9d9;
    border-bottom-style: solid;
    border-bottom-width: 1px;
}

.editorDivider {
    width: 1px;
    background-color: #d9d9d9;
    height: 36px;
}

.editorColorInput {
    max-width: 30px;
    padding: 4px;
    height: 30px;
    cursor: pointer;
    border-radius: 2px;
}
</style>
