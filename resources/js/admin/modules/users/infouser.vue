<template>
    <div class="user_info is-relative">
        <div class="title is-5 ml-1">Información</div>

        <div class="box">
            <b-field
                label="Nombre"
                :type="getErrorMsgTool(errors, 'name', { class: 'is-danger' })"
                :message="getErrorMsgTool(errors, 'name')">
                <b-input v-model="user.name" size="is-small" type="text" placeholder="Nombre" />
            </b-field>

            <b-field
                label="Apellido"
                :type="getErrorMsgTool(errors, 'lastname', { class: 'is-danger' })"
                :message="getErrorMsgTool(errors, 'lastname')">
                <b-input v-model="user.lastname" size="is-small" type="text" placeholder="Apellido" />
            </b-field>

            <b-field
                label="Correo"
                :type="getErrorMsgTool(errors, 'email', { class: 'is-danger' })"
                :message="getErrorMsgTool(errors, 'email')">
                <b-input v-model="user.email" size="is-small" type="email" placeholder="Correo" />
            </b-field>

            <b-field
                label="Tipo"
                :type="getErrorMsgTool(errors, 'type', { class: 'is-danger' })"
                :message="getErrorMsgTool(errors, 'type')">
                <b-select v-model="user.type" size="is-small" expanded>
                    <option v-for="(user_type, i) in user_types" :key="i" :value="user_type">
                        {{ user_type }}
                    </option>
                </b-select>
            </b-field>
        </div>

        <div class="title is-5 ml-1">Seguridad</div>

        <div class="box">
            <b-field
                label="Contraseña"
                :type="getErrorMsgTool(errors, 'password', { class: 'is-danger' })"
                :message="getErrorMsgTool(errors, 'password')">
                <b-input v-model="password.password" size="is-small" type="password" />
            </b-field>

            <b-field
                label="Confirmación de Contraseña"
                :type="getErrorMsgTool(errors, 'password_confirmation', { class: 'is-danger' })"
                :message="getErrorMsgTool(errors, 'password_confirmation')">
                <b-input v-model="password.password_confirmation" size="is-small" type="password" />
            </b-field>

            <div v-if="update_on" class="buttons is-justify-content-flex-end">
                <b-button size="is-small" type="is-primary" icon-left="sync-alt" @click="updateUserPassword">
                    Actualizar Contraseña
                </b-button>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useUserStore from "./store"
import useAuthStore from "@admin/modules/auth/store"
import { getErrorMsgTool } from "@admin/tools"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    mixins: [handleErrorMessages, toastNotifications],
    computed: {
        ...mapState(useAuthStore, ["user_types"]),
        ...mapState(useUserStore, ["errors", "update_on"]),
        ...mapWritableState(useUserStore, ["user", "password"])
    },
    methods: {
        ...mapActions(useUserStore, ["updatePassword"]),
        updateUserPassword() {
            this.updatePassword()
                .then(() => {
                    this.successToast("Contraseña actualizada!")
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        },
        getErrorMsgTool: getErrorMsgTool
    }
}
</script>
