<template>
    <node-view-wrapper as="span">
        <img ref="resizableImg" v-bind="node.attrs" :draggable="isDraggable" :data-drag-handle="isDraggable" />
    </node-view-wrapper>
</template>

<script>
import { NodeViewWrapper, nodeViewProps } from "@tiptap/vue-2"

export default {
    components: { NodeViewWrapper },
    props: nodeViewProps,
    data() {
        return {
            // When is resizing
            isResizing: false,
            // We keep last movement calculation so we can
            // determine if the image is going to get larger or smaller
            lastMovement: 0,
            // Original aspect ratio of the img
            aspectRatio: 0
        }
    },

    computed: {
        // The isDraggable attr from 'resizable-image.js'
        isDraggable() {
            return this.node?.attrs?.isDraggable
        }
    },
    mounted() {
        // When the image has loaded
        this.$refs.resizableImg.onload = () => {
            // Aspect Ratio from its original size
            this.aspectRatio = this.$refs.resizableImg.naturalWidth / this.$refs.resizableImg.naturalHeight
        }

        // On mouse down, start resizing
        // eslint-disable-next-line no-unused-vars
        this.$refs.resizableImg.addEventListener("mousedown", (e) => {
            // We are not resizing if the img is draggable
            if (this.isDraggable) {
                return
            }
            this.isResizing = true
        })

        // On mouse move, resize
        this.$refs.resizableImg.addEventListener("mousemove", (e) => {
            if (!this.isResizing) {
                return
            }

            // TL;DR: Current movement is larger, img is larger.
            // Current movement is smaller, img is smaller.
            //
            // Using the Pythagorean theorem we are getting the magnitude
            // of the vector/position of the mouse. If it is larger than the
            // previous one, then we make the image larger, and viceversa.
            // This makes the img larger when the mouse is moving to the bottom right of it.
            let movement = Math.sqrt(Math.pow(e.offsetY, 2) + Math.pow(e.offsetX, 2))

            if (this.lastMovement > 0) {
                if (movement > this.lastMovement) {
                    this.resizeAspectRatio(true)
                } else if (movement < this.lastMovement) {
                    this.resizeAspectRatio(false)
                }
            }

            this.lastMovement = movement
        })

        // We stop resizing when releasing the click button.
        // Caveat: it only works when the mouse is over the img.
        // eslint-disable-next-line no-unused-vars
        this.$refs.resizableImg.addEventListener("mouseup", (e) => {
            this.isResizing = false
            this.lastMovement = 0
        })
    },
    methods: {
        resizeAspectRatio(grow) {
            let calcW
            let calcH

            // We just add or subtract 1 to the height
            if (grow) {
                calcH = this.$refs.resizableImg.height + 1
            } else {
                calcH = this.$refs.resizableImg.height - 1
            }

            // And calculate the width with the Aspect Ratio
            calcW = calcH * this.aspectRatio

            // Tell Tiptap to update width and height
            this.updateAttributes({ width: calcW, height: calcH })
        }
    }
}
</script>
