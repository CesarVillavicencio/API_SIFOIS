<template>
    <div class="box">
        <imageupload
            :image="user.avatar"
            :hasfile="hasFile"
            :loading="loading"
            @remove="removeImage"
            @upload="uploadImage" />
    </div>
</template>

<script>
import { mapWritableState, mapActions } from "pinia"
import useUserStore from "./store"
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
        ...mapWritableState(useUserStore, ["user"])
    },
    mounted() {
        if (this.$route.name == this.$namedRoutes.users.edit) {
            this.hasFile = true
        }
    },
    methods: {
        ...mapActions(useUserStore, ["uploadAvatar"]),
        removeImage() {
            this.hasFile = false
            this.user.avatar = ""
        },
        uploadImage(file) {
            this.loading = true
            this.uploadAvatar(file)
                .then(() => {
                    this.successToast("Archivo de imagen subida!")
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
