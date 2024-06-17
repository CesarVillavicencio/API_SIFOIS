<template>
    <div class="box">
        <h3 class="is-size-6 has-text-weight-bold mb-2">Foto</h3>
        <imageupload
            :image="photo.image"
            :hasfile="hasFile"
            :loading="loading"
            @remove="removeImage"
            @upload="uploadImage" />
    </div>
</template>

<script>
import { mapWritableState, mapActions } from "pinia"
import useGalleryStore from "./store"
import imageupload from "@admin/components/imageupload.vue"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    components: { imageupload },
    mixins: [handleErrorMessages, toastNotifications],
    data() {
        return {
            hasFile: false,
            loading: false
        }
    },
    computed: {
        ...mapWritableState(useGalleryStore, ["photo"])
    },
    mounted() {
        if (this.$route.name == this.$namedRoutes.gallery.edit) {
            this.hasFile = true
        }
    },
    methods: {
        ...mapActions(useGalleryStore, ["uploadPhotoImage"]),
        removeImage() {
            this.hasFile = false
            this.photo.image = ""
            this.photo.thumb = ""
        },
        uploadImage(file) {
            this.loading = true
            this.uploadPhotoImage(file)
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
