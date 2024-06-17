<template>
    <div class="box">
        <imageupload
            :image="post.image"
            :hasfile="hasFile"
            :loading="loading"
            @remove="removeImage"
            @upload="uploadImage" />
    </div>
</template>

<script>
import { mapWritableState, mapActions } from "pinia"
import useBlogStore from "./store"
import imageupload from "@admin/components/imageupload.vue"
import { toastNotifications } from "@admin/helpers/toastNotifications"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"

export default {
    components: { imageupload },
    mixins: [toastNotifications, handleErrorMessages],
    data() {
        return {
            hasFile: false,
            loading: false
        }
    },
    computed: {
        ...mapWritableState(useBlogStore, ["post"])
    },
    mounted() {
        if (this.$route.name == this.$namedRoutes.blog.edit) {
            this.hasFile = true
        }
    },
    methods: {
        ...mapActions(useBlogStore, ["uploadPostImage"]),
        removeImage() {
            this.hasFile = false
            this.post.image = ""
            this.post.thumb = ""
        },
        uploadImage(file) {
            this.loading = true
            this.uploadPostImage(file)
                .then(() => {
                    this.successToast("Archivo de imagen subido!")
                    this.hasFile = true
                    this.loading = false
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                    this.loading = false
                })
        }
    }
}
</script>
