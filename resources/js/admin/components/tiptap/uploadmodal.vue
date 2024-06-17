<template>
    <div class="modal-card mobile-padding" style="width: auto">
        <header class="modal-card-head">
            <p class="modal-card-title">Subir Imagen</p>
            <button type="button" class="delete" @click="$emit('close')" />
        </header>
        <section class="modal-card-body is-justify-content-center">
            <imageupload
                :image="img"
                :hasfile="hasFile"
                :loading="loading"
                @remove="removeImage"
                @upload="uploadImage" />
        </section>
        <footer class="modal-card-foot is-justify-content-end">
            <b-button label="Cerrar" @click="$emit('close')" />
        </footer>
    </div>
</template>

<script>
import imageupload from "@admin/components/imageupload.vue"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { isStorageFile } from "@admin/tools"

export default {
    components: { imageupload },
    mixins: [handleErrorMessages],
    data() {
        return {
            loading: false,
            hasFile: false,
            img: ""
        }
    },
    methods: {
        removeImage() {
            this.img = ""
            this.hasFile = false
        },
        uploadImage(file) {
            this.loading = true
            var form = new FormData()
            form.append("image", file)
            window.axios
                .post("/image", form, {
                    headers: { "Content-Type": "multipart/form-data" }
                })
                .then((res) => {
                    this.img = res.data
                    this.hasFile = true
                    this.loading = false
                    this.$emit("uploaded", isStorageFile(this.img))
                    this.$emit("close")
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                    this.loading = false
                    this.$emit("close")
                })
        }
    }
}
</script>

<style scoped>
@media (max-width: 768px) {
    .mobile-padding {
        padding: 15px;
    }
}
</style>
