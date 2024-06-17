<template>
    <div class="columns">
        <div class="column is-12">
            <editor v-model="post.content" />
        </div>
    </div>
</template>

<script>
import { mapWritableState } from "pinia"
import useBlogStore from "./store"
import editor from "@admin/components/tiptap/editor.vue"

export default {
    components: { editor },
    computed: {
        ...mapWritableState(useBlogStore, ["post"])
    }
}
</script>
