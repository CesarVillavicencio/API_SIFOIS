import Image from "@tiptap/extension-image"
import { VueNodeViewRenderer } from "@tiptap/vue-2"
import ResizableImageTemplate from "./ResizableImageTemplate.vue"

export default Image.extend({
    name: "ResizableImage",
    addNodeView() {
        return VueNodeViewRenderer(ResizableImageTemplate)
    },
    addAttributes() {
        return {
            // Inherit all the attrs of the Image extension
            ...this.parent?.(),

            // New attrs
            width: {
                default: "100%",
                // tell them to render on the img tag
                renderHTML: (attributes) => {
                    return {
                        width: attributes.width
                    }
                }
            },

            height: {
                default: "auto",
                renderHTML: (attributes) => {
                    return {
                        height: attributes.height
                    }
                }
            },

            // We'll use this to tell if we are going to drag the image
            // through the editor or if we are resizing it
            isDraggable: {
                default: true,
                // We don't want it to render on the img tag
                // eslint-disable-next-line no-unused-vars
                renderHTML: (attributes) => {
                    return {}
                }
            }
        }
    },
    addCommands() {
        return {
            // Inherit all the commands of the Image extension.
            // This way we can add images as always:
            // this.editor.chain().focus()
            //      .setImage({
            //          src: 'https://source.unsplash.com/8xznAGy4HcY/800x400',
            //          width: '80',
            //          height: '40'
            //      })
            //      .run();
            ...this.parent?.(),

            // New command that is going to be called like:
            // this.editor.chain().focus().toggleResizable().run();
            toggleResizable:
                () =>
                ({ tr }) => {
                    // eslint-disable-next-line no-unsafe-optional-chaining
                    const { node } = tr?.selection

                    if (node?.type?.name === "ResizableImage") {
                        node.attrs.isDraggable = !node.attrs.isDraggable
                    }
                }
        }
    }
})
