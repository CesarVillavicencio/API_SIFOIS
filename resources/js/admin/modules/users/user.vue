<template>
    <div class="user_inputs is-relative">
        <b-loading v-model="loading" :is-full-page="false" />

        <h2 class="title">
            <font-awesome-icon :icon="['fa', 'user']" />
            {{ getTitle }}
        </h2>

        <div class="buttons mb-4">
            <b-button size="is-small" icon-left="arrow-left" @click="goBack"> Regresar </b-button>
            <b-button v-if="update_on" size="is-small" type="is-primary" icon-left="pen-square" @click="update">
                Actualizar
            </b-button>
            <b-button v-else size="is-small" type="is-primary" icon-left="plus-square" @click="create">
                Crear
            </b-button>
        </div>

        <errorlist :errors="errors" />

        <div class="columns">
            <div class="column">
                <infouser />
            </div>
            <div class="column">
                <div class="title is-5 ml-1">Avatar</div>
                <avatarupload />
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useUserStore from "./store"
import infouser from "./infouser.vue"
import avatarupload from "./avatarupload.vue"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"
import errorlist from "@admin/components/errorlist.vue"

export default {
    components: { infouser, avatarupload, errorlist },
    mixins: [handleErrorMessages, toastNotifications],
    beforeRouteLeave(to, from, next) {
        this.cleanForm()
        next()
    },
    computed: {
        ...mapState(useUserStore, ["errors", "loading"]),
        ...mapWritableState(useUserStore, ["update_on"]),
        getTitle() {
            return this.update_on ? "Actualizar Usuario" : "Crear Usuario"
        }
    },
    mounted() {
        if (this.$route.name == this.$namedRoutes.users.edit) {
            this.update_on = true
            this.getUser(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions(useUserStore, ["getUser", "createUser", "updateUser", "cleanForm"]),
        goBack() {
            this.$router.replace({ name: this.$namedRoutes.users.list })
        },
        create() {
            this.createUser()
                .then(() => {
                    this.successToast("Usuario creado!")
                    this.update_on = false
                    this.$router.push({ name: this.$namedRoutes.users.list })
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        },
        update() {
            this.updateUser()
                .then(() => {
                    this.successToast("Usuario actualizado!")
                    this.update_on = false
                    this.$router.push({ name: this.$namedRoutes.users.list })
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        }
    }
}
</script>
