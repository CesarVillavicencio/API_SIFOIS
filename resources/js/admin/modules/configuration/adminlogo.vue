<template>
    <div class="box">
        <h3 class="subtitle">Imagen del Logo del Administrador</h3>

        <p class="mb-4">La imagen debe ser de 200x200 pixeles.</p>

        <b-message type="is-warning"> SIN USO </b-message>

        <imageupload
            :image="configuration.admin_logo"
            :hasfile="hasFile"
            :loading="loading"
            @remove="removeImage"
            @upload="uploadImage" />
    </div>
</template>

<script>
import { storeToRefs } from "pinia"
import useConfigurationStore from "./store"
import useAuthStore from "@admin/modules/auth/store"
import imageupload from "@admin/components/imageupload.vue"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    components: { imageupload },
    mixins: [handleErrorMessages, toastNotifications],
    setup() {
        const store = useConfigurationStore()
        const authStore = useAuthStore()
        const { configuration } = storeToRefs(store)

        const uploadAdminLogo = (file) => store.uploadAdminLogo(file)
        const setAppOptionsAdminLogo = (value) => (authStore.app_options.admin_logo = value)

        return {
            configuration,
            uploadAdminLogo,
            setAppOptionsAdminLogo
        }
    },
    data() {
        return {
            hasFile: true,
            loading: false
        }
    },
    methods: {
        removeImage() {
            this.hasFile = false
            this.configuration.admin_logo = ""
        },
        uploadImage(file) {
            this.loading = true
            this.uploadAdminLogo(file)
                .then((configuration) => {
                    this.successToast("Imagen del logo del administrador actualizada!")
                    this.hasFile = true
                    this.loading = false
                    this.setAppOptionsAdminLogo(configuration.options.login_background_url)
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                    this.loading = false
                })
        }
    }
}
</script>
