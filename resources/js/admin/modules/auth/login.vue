<template>
    <section class="hero is-fullheight" :class="getBackgroundClass" :style="getAuthBackgroundStyle">
        <div class="hero-body">
            <div class="container">
                <div class="is-flex is-justify-content-center">
                    <figure class="image" style="width: 150px">
                        <img style="width: 100%; height: auto" :src="isAssetFile($appLogo)" />
                    </figure>
                </div>

                <div class="title has-text-centered">
                    <b>{{ $appName }} Admin</b>
                </div>

                <div class="columns">
                    <div class="column is-4 is-offset-4">
                        <div class="box is-relative">
                            <b-loading v-model="loading" :is-full-page="false" />

                            <b-message type="is-info" size="is-small">
                                Utilice sus credenciales de administrador para iniciar sesión
                            </b-message>

                            <div class="subtitle is-6 has-text-centered"></div>

                            <b-field
                                label="Usuario"
                                :type="getErrorMsgTool(errors, 'username', { class: 'is-danger' })"
                                :message="getErrorMsgTool(errors, 'username')">
                                <b-input
                                    id="login_email_input"
                                    v-model="credentials.username"
                                    size="is-small"
                                    type="text"
                                    placeholder=""
                                    icon="user"
                                    @keydown.enter.native="doLogin">
                                </b-input>
                            </b-field>

                            <b-field
                                label="Contraseña"
                                :type="getErrorMsgTool(errors, 'password', { class: 'is-danger' })"
                                :message="getErrorMsgTool(errors, 'password')">
                                <b-input
                                    v-model="credentials.password"
                                    type="password"
                                    size="is-small"
                                    placeholder="********"
                                    icon="lock"
                                    @keydown.enter.native="doLogin">
                                </b-input>
                            </b-field>

                            <div class="mt-4 buttons is-justify-content-center">
                                <b-button type="is-primary" size="is-small" @click="doLogin"> Ingresar </b-button>
                            </div>

                            <div v-if="isLocalDev">
                                <div class="divider">DEV TOOLS</div>
                                <div class="is-flex is-justify-content-center">
                                    <button
                                        class="button is-primary is-light is-small mr-2"
                                        @click="doLoginDev('admin')">
                                        Login as Admin
                                    </button>
                                    <button
                                        class="button is-success is-light is-small mr-2"
                                        @click="doLoginDev('suadmin')">
                                        Login as SuAdmin
                                    </button>
                                    <button class="button is-danger is-light is-small" @click="destroyToken">
                                        Destroy Token
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useAuthStore from "./store"
import { getErrorMsgTool, isAssetFile, isStorageFile } from "@admin/tools"

export default {
    beforeRouteLeave(to, from, next) {
        this.credentials.username = ""
        this.credentials.password = ""
        next()
    },
    computed: {
        ...mapState(useAuthStore, ["loading", "errors", "auth_background"]),
        ...mapWritableState(useAuthStore, {
            credentials: "loginData"
        }),
        isLocalDev() {
            return this.$appEnv == "local"
        },
        getBackgroundClass() {
            return this.auth_background ? "default_gradient_background" : ""
        },
        getAuthBackgroundStyle() {
            if (!this.auth_background) return {}
            return {
                "background-image": 'url("' + isStorageFile(this.auth_background) + '")',
                "background-position": "center",
                "background-repeat": "no-repeat",
                "background-size": "cover"
            }
        }
    },
    mounted() {
        document.getElementById("login_email_input").focus()
    },
    methods: {
        ...mapActions(useAuthStore, ["login", "destroyToken", "devLoginAsRandomAdmin"]),
        doLogin() {
            this.login().then(() => {
                this.$router.replace({ name: this.$namedRoutes.dashboard })
            })
        },
        doLoginDev(admintype = "admin") {
            this.devLoginAsRandomAdmin(admintype).then(() => {
                this.$router.replace({ name: this.$namedRoutes.dashboard })
            })
        },
        getErrorMsgTool: getErrorMsgTool,
        isAssetFile: isAssetFile
    }
}
</script>
