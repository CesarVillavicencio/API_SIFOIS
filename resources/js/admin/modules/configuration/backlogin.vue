<template>
    <div class="box">
        <h3 class="subtitle">Imagen de fondo del Login</h3>

        <imageupload
            :image="configuration.login_background_url"
            :hasfile="hasFile"
            :loading="loading"
            @remove="removeImage"
            @upload="uploadImage" />

        <div v-if="hasFile" class="buttons is-justify-content-center mt-4">
            <b-button icon-left="square" type="is-info" @click="resetToDefault"> Predeterminado </b-button>
        </div>
    </div>
</template>

<script>
import { mapActions, mapWritableState } from "pinia"
import useConfigurationStore from "./store"
import useAuthStore from "@admin/modules/auth/store"
import imageupload from "@admin/components/imageupload.vue"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    components: { imageupload },
    mixins: [handleErrorMessages, toastNotifications],
    setup() {
        const authStore = useAuthStore()
        const setAppOptionsAuthBackground = (value) => (authStore.app_options.login_background_url = value)

        return {
            setAppOptionsAuthBackground
        }
    },
    data() {
        return {
            hasFile: true,
            loading: false
        }
    },
    computed: {
        ...mapWritableState(useConfigurationStore, ["configuration"])
    },
    mounted() {
        this.hasFile = !!this.configuration.login_background_url
    },
    methods: {
        ...mapActions(useConfigurationStore, ["uploadLoginBackgroundUrl", "resetLoginBackgroundUrl"]),
        removeImage() {
            this.hasFile = false
            this.configuration.login_background_url = ""
        },
        uploadImage(file) {
            this.loading = true
            this.uploadLoginBackgroundUrl(file)
                .then((configuration) => {
                    this.successToast("Imagen de fondo del login actualizada!")
                    this.hasFile = true
                    this.loading = false
                    this.setAppOptionsAuthBackground(configuration.options.login_background_url)
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                    this.loading = false
                })
        },
        resetToDefault() {
            this.$buefy.dialog.confirm({
                title: "Imagen de Fondo del Login",
                message: "¿Está seguro de que desea <b> cambiarlo </b>?",
                confirmText: "Si",
                cancelText: "No",
                type: "is-info",
                hasIcon: true,
                onConfirm: () => {
                    this.resetLoginBackgroundUrl()
                        .then(() => {
                            this.successToast("Imagen de fondo del login actualizada!")
                            this.uploadedFile = false
                            this.setAppOptionsAuthBackground(null)
                        })
                        .catch((error) => {
                            this.handleErrorMessage(error)
                        })
                }
            })
        }
    }
}
</script>
