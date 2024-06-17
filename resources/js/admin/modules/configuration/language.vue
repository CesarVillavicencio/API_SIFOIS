<template>
    <div class="box">
        <b-message type="is-warning"> SIN USO </b-message>

        <b-field label="Idioma">
            <b-select v-model="configuration.language" expanded>
                <option v-for="(l, i) in languages" :key="i" :value="l.value">
                    {{ l.text }}
                </option>
            </b-select>
        </b-field>

        <div class="buttons is-justify-content-flex-end">
            <b-button type="is-primary" icon-left="sync-alt" @click="update"> Actualizar </b-button>
        </div>
    </div>
</template>

<script>
import { storeToRefs } from "pinia"
import useConfigurationStore from "./store"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    mixins: [handleErrorMessages, toastNotifications],
    setup() {
        const store = useConfigurationStore()
        const { configuration } = storeToRefs(store)

        const updateLanguage = () => store.updateLanguage()

        return {
            configuration,
            updateLanguage
        }
    },
    data() {
        return {
            languages: [
                { text: "Español", value: "es" },
                { text: "English", value: "en" }
            ]
        }
    },
    methods: {
        update() {
            this.updateLanguage()
                .then(() => {
                    this.successToast("Idioma actualizado!")
                    // localStorage.setItem('admin_language', configuration.options.language)
                    // this.$i18n.locale = configuration.options.language
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        }
    }
}
</script>
