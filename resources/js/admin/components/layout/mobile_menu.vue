<template>
    <b-sidebar v-model="mobile_menu_open" type="is-light" fullheight fullwidth right>
        <div class="p-1 is-relative mt-6">
            <!-- 
        <div style="position: absolute; top: 10px; right: 10px;">
            <b-button type="is-danger" icon-right="times-circle" @click="closeMobileMenu" />
        </div>
        -->

            <!-- User Data -->
            <div class="mb-4">
                <!-- Logo -->
                <div class="is-flex is-justify-content-center">
                    <figure class="image is-4by3">
                        <img class="is-rounded mr-2" style="width: 100px; height: 100px" :src="isAssetFile($appLogo)" />
                    </figure>
                </div>

                <!-- User Data -->
                <div style="margin-top: 20px">
                    <b-menu :activable="false">
                        <b-menu-list>
                            <b-menu-item :active="false">
                                <div slot="label">
                                    Nombre: <b>{{ user_data.name }}</b>
                                </div>
                            </b-menu-item>
                            <b-menu-item :active="false">
                                <div slot="label">
                                    Creado Por: <b>{{ user_data.creator }}</b>
                                </div>
                            </b-menu-item>
                            <b-menu-item :active="false">
                                <div slot="label">
                                    Fecha de creación:
                                    <b>{{ $dayjs(user_data.created_at).format("DD/MM/YYYY HH:mm:ss") }}</b>
                                </div>
                            </b-menu-item>
                        </b-menu-list>
                    </b-menu>
                </div>
            </div>

            <!-- Shortcuts & Search -->

            <div class="mb-4">
                <div class="m-4">
                    <b-field label="Buscar" label-position="on-border">
                        <b-input
                            v-model="search_text"
                            placeholder="Buscar..."
                            icon="search"
                            @keydown.enter.native="goSearch" />
                    </b-field>
                </div>
            </div>

            <!-- Other Links -->
            <b-menu>
                <b-menu-list>
                    <b-menu-item label="Editar Usuario" icon="user-edit" :active="false" @click="goEditUser" />
                    <b-menu-item label="Configuración" icon="cogs" :active="false" @click="goConfigurations" />
                    <b-menu-item label="Cerrar Sesión" icon="sign-out-alt" :active="false" @click="signOut" />
                    <b-menu-item label="Cerrar" icon="times-circle" :active="false" @click="closeMobileMenu" />
                </b-menu-list>
            </b-menu>
        </div>
    </b-sidebar>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useAuthStore from "@admin/modules/auth/store"
import useSystemStore from "@admin/components/store"
import { isAssetFile } from "@admin/tools"

export default {
    data() {
        return {
            search_text: ""
        }
    },
    computed: {
        ...mapState(useAuthStore, ["user_data"]),
        ...mapWritableState(useSystemStore, ["mobile_menu_open"])
    },
    methods: {
        ...mapActions(useAuthStore, ["logout"]),
        goRoute(route_name) {
            this.$router.push({ name: route_name })
            this.closeMobileMenu()
        },
        goSearch() {
            this.$router.push({ name: this.$namedRoutes.search })
            this.closeMobileMenu()
        },
        goEditUser() {
            this.$router.push({
                name: this.$namedRoutes.users.edit,
                params: { id: this.user_data.id }
            })
            this.closeMobileMenu()
        },
        goConfigurations() {
            this.$router.push({ name: this.$namedRoutes.configuration })
            this.closeMobileMenu()
        },
        signOut() {
            this.logout().then(() => {
                window.location.reload()
            })
        },
        closeMobileMenu() {
            this.mobile_menu_open = false
        },
        isAssetFile: isAssetFile
    }
}
</script>
