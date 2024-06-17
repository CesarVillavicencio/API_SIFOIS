<template>
    <div class="box">
        <b-field label="Sitio en mantenimiento">
            <b-select v-model="configuration.front_site_up" size="is-small" expanded>
                <option v-for="(option, i) in getSiteOptions" :key="i" :value="option.value">
                    {{ option.text }}
                </option>
            </b-select>
        </b-field>

        <div class="buttons is-justify-content-flex-end">
            <b-button type="is-primary" icon-left="sync-alt" size="is-small" @click="update"> Actualizar </b-button>
        </div>
    </div>
</template>

<script>
import { storeToRefs } from "pinia"
import useConfigurationStore from "./store"
import useAuthStore from "@admin/modules/auth/store"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    mixins: [handleErrorMessages, toastNotifications],
    setup() {
        const store = useConfigurationStore()
        const authStore = useAuthStore()
        const { configuration } = storeToRefs(store)

        const updateFrontSiteUp = () => store.updateFrontSiteUp()
        const setAppOptionsFrontSiteUp = (value) => (authStore.app_options.front_site_up = value)

        return {
            configuration,
            updateFrontSiteUp,
            setAppOptionsFrontSiteUp
        }
    },
    computed: {
        getSiteOptions() {
            return [
                { text: "Si", value: true },
                { text: "No", value: false }
            ]
        }
    },
    methods: {
        update() {
            this.updateFrontSiteUp()
                .then((configuration) => {
                    this.successToast("Sitio en mantenimiento actualizado!")
                    this.setAppOptionsFrontSiteUp(configuration.options.front_site_up)
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        }
    }
}
</script>
