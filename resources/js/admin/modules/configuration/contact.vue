<template>
    <div class="box">
        <errorlist :errors="contact_errors" />

        <b-field
            label="Correo de Contacto"
            :type="getErrorMsgTool(contact_errors, 'contact_email', { class: 'is-danger' })"
            :message="getErrorMsgTool(contact_errors, 'contact_email')">
            <b-input v-model="configuration.contact_email" size="is-small" type="text" placeholder="Correo"> </b-input>
        </b-field>

        <div class="buttons is-justify-content-flex-end">
            <b-button type="is-primary" icon-left="sync-alt" size="is-small" @click="update"> Actualizar </b-button>
        </div>
    </div>
</template>

<script>
import { storeToRefs } from "pinia"
import useConfigurationStore from "./store"
import errorlist from "@admin/components/errorlist.vue"
import { getErrorMsgTool } from "@admin/tools"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    components: { errorlist },
    mixins: [handleErrorMessages, toastNotifications],
    setup() {
        const store = useConfigurationStore()
        const { configuration, contact_errors } = storeToRefs(store)

        const updateContactEmail = () => store.updateContactEmail()

        return {
            configuration,
            contact_errors,
            updateContactEmail
        }
    },
    methods: {
        update() {
            this.updateContactEmail()
                .then(() => {
                    this.successToast("Correo de contacto actualizado!")
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        },
        getErrorMsgTool: getErrorMsgTool
    }
}
</script>
