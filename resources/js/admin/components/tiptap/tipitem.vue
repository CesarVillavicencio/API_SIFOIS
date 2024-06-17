<template>
    <button class="button is-small" :class="isActive() ? 'is-light' : ''" :title="title" @click="action">
        <span class="icon is-small">
            <img :src="isAssetFile(`images/tiptap/icons/${icon}.svg`)" height="32" width="32" />
        </span>
    </button>
</template>

<script>
import { isAssetFile } from "@admin/tools"

export default {
    props: {
        icon: {
            type: String,
            required: true
        },
        title: {
            type: String,
            required: true
        },
        action: {
            type: Function,
            required: true
        },
        isActive: {
            type: Function,
            default: () => {}
        }
    },
    methods: {
        isAssetFile: isAssetFile
    }
}
</script>
