<template>
    <nav
        class="navbar m-4 navstyle"
        :class="app_options.navbar_back_color"
        role="navigation"
        aria-label="main navigation">
        <!-- Mobile Menu -->
        <div class="navbar-brand">
            <a class="navbar-item is-hidden-desktop">
                <b-button type="is-primary" icon-right="bars" @click="toggleMobileSideBar" />
            </a>

            <div class="navbar-item is-hidden-desktop">
                <div class="is-flex is-align-items-center is-flex-wrap-wrap">
                    <img :src="isAssetFile($appLogo)" />
                    <div class="ml-2">
                        <b>{{ $appName }}</b>
                    </div>
                </div>
            </div>

            <a
                role="button"
                class="navbar-burger"
                aria-label="menu"
                aria-expanded="false"
                data-target="navbarBasicExample"
                style="height: 64px"
                @click="toggleMobileMenu">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <!-- Desktop Menu -->
        <div class="navbar-menu">
            <div class="navbar-start">
                <!-- SideBar Toggle -->
                <a class="navbar-item">
                    <b-button type="is-primary" icon-right="bars" @click="toggleSideBarCompact" />
                </a>

                <!-- Search on Modules 
            <div class="navbar-item">
                <b-field label="Buscar" label-position="on-border">
                    <b-input
                        v-model="search_text"
                        placeholder="Buscar..."
                        icon="search"
                        @keydown.enter.native="goSearch" />
                </b-field>
            </div>
            -->

                <!-- Ambient Status -->
                <div v-if="canShowEnvTag" class="navbar-item">
                    <button class="button" :class="envTagTextAndType[1]" style="opacity: 1 !important" disabled>
                        {{ envTagTextAndType[0] }}
                    </button>
                </div>
                <!-- Ambient Status -->
            </div>

            <div class="navbar-end">
                <!-- Maintanence Mode On -->
                <b-dropdown
                    v-if="app_options.front_site_up"
                    append-to-body
                    position="is-bottom-left"
                    aria-role="menu"
                    scrollable
                    max-height="200"
                    trap-focus>
                    <template #trigger>
                        <a
                            class="navbar-item has-tooltip-arrow has-tooltip-left has-tooltip-multiline has-tooltip-danger"
                            role="button"
                            data-tooltip="El sitio está en modo mantenimiento!">
                            <font-awesome-icon :icon="['fa', 'exclamation-triangle']" :style="{ color: 'red' }" />
                        </a>
                    </template>

                    <b-dropdown-item aria-role="listitem"> El sitio está en modo mantenimiento! </b-dropdown-item>
                    <hr class="dropdown-divider" />
                    <b-dropdown-item aria-role="listitem" @click="goConfigurations">
                        <font-awesome-icon :icon="['fa', 'cogs']" />
                        Ir a Configuración
                    </b-dropdown-item>
                </b-dropdown>

                <!-- Notifications -->
                <b-dropdown position="is-bottom-left" aria-role="menu" scrollable max-height="500" trap-focus>
                    <template #trigger>
                        <a class="navbar-item is-relative" role="button" @click="openNotifications">
                            <font-awesome-icon :icon="['fa', 'bell']" />
                            <span v-if="user_data.new_notifications != 0" class="tag is-success notificationsNumber">
                                {{ user_data.new_notifications }}
                            </span>
                        </a>
                    </template>

                    <div v-if="loading_notifications" class="is-relative" style="height: 100px">
                        <b-loading v-model="loading_notifications" :is-full-page="false" />
                    </div>

                    <div v-else>
                        <b-dropdown-item
                            v-for="notification in notifications"
                            :key="notification.id"
                            custom
                            aria-role="menuitem">
                            <div class="clickeable menuSelectable">
                                <div class="is-flex is-align-items-center">
                                    <font-awesome-icon :icon="['fa', notification.icon]" />
                                    <div class="is-size-6 has-text-weight-bold ml-2">{{ notification.title }}</div>
                                </div>
                                <small class="is-size-7" style="overflow: hidden; word-break: break-all">
                                    {{ notification.message }}
                                </small>
                            </div>
                        </b-dropdown-item>
                    </div>
                </b-dropdown>
                <!-- Notifications -->

                <!-- User Menu -->
                <b-dropdown position="is-bottom-left" append-to-body aria-role="menu">
                    <template #trigger>
                        <a class="navbar-item" role="button">
                            <fitimage
                                ratio=""
                                container-class="mr-2"
                                imgclasses="is-rounded"
                                :img="user_data.avatar"
                                style="width: 25px; height: 25px; overflow: hidden" />
                            <font-awesome-icon :icon="['fa', 'caret-down']" />
                        </a>
                    </template>

                    <b-dropdown-item custom aria-role="menuitem">
                        <div class="is-flex is-justify-content-center">
                            <fitimage
                                ratio=""
                                container-class="mr-2"
                                imgclasses="is-rounded"
                                :img="user_data.avatar"
                                style="width: 50px; height: auto" />
                        </div>
                    </b-dropdown-item>
                    <b-dropdown-item custom aria-role="menuitem">
                        Nombre: <b>{{ user_data.name }}</b>
                    </b-dropdown-item>
                    <b-dropdown-item custom aria-role="menuitem">
                        Tipo: <b>{{ user_data.type }}</b>
                    </b-dropdown-item>
                    <b-dropdown-item custom aria-role="menuitem">
                        Fecha de creación:
                        <b>{{ $dayjs(user_data.created_at).format("DD/MM/YYYY HH:mm:ss") }}</b>
                    </b-dropdown-item>

                    <hr class="dropdown-divider" />

                    <b-dropdown-item value="edituser" @click="goEditUser">
                        <font-awesome-icon :icon="['fa', 'user-edit']" />
                        Editar Usuario
                    </b-dropdown-item>
                    <b-dropdown-item value="settings" @click="goConfigurations">
                        <font-awesome-icon :icon="['fa', 'cogs']" />
                        Configuración
                    </b-dropdown-item>
                    <b-dropdown-item value="logout" aria-role="menuitem" @click="signOut">
                        <font-awesome-icon :icon="['fa', 'sign-out-alt']" />
                        Cerrar Sesión
                    </b-dropdown-item>
                </b-dropdown>
            </div>
        </div>
    </nav>
</template>

<script>
import { mapState, mapActions } from "pinia"
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
        ...mapState(useSystemStore, ["notifications", "loading_notifications"]),
        ...mapState(useAuthStore, ["user_data", "app_options"]),
        canShowEnvTag() {
            return ["QA", "DEV", "LOCAL"].includes(this.$appEnvString)
        },
        envTagTextAndType() {
            switch (this.$appEnvString) {
                case "LOCAL":
                    return ["AMBIENTE: LOCAL", "is-success"]
                case "DEV":
                    return ["AMBIENTE: DEV", "is-info"]
                case "QA":
                    return ["AMBIENTE: QA", "is-warning"]
                default:
                    return ["", ""]
            }
        }
    },
    methods: {
        ...mapActions(useAuthStore, ["logout", "setUserNewNotifications"]),
        ...mapActions(useSystemStore, [
            "toggleSideBarCompact",
            "toggleMobileSideBar",
            "toggleMobileMenu",
            "getUserNotifications"
        ]),
        goSearch() {
            this.$router.push({ name: this.$namedRoutes.search })
        },
        goEditUser() {
            this.$router.push({
                name: this.$namedRoutes.users.edit,
                params: { id: this.user_data.id }
            })
        },
        goConfigurations() {
            this.$router.push({ name: this.$namedRoutes.configuration })
        },
        signOut() {
            this.logout().then(() => {
                window.location.reload()
            })
        },
        goRoute(route_name) {
            this.$router.push({ name: route_name })
        },
        openNotifications() {
            this.setUserNewNotifications(0)
            /*this.getUserNotifications().then(() => {
                this.setUserNewNotifications(0)
            })*/
        },
        isAssetFile: isAssetFile
    }
}
</script>

<style scoped>
.navstyle {
    border-radius: 8px;
    -webkit-box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
    box-shadow: 0 4px 24px 0 rgba(34, 41, 47, 0.1);
}

.notificationsNumber {
    position: absolute;
    top: 12px;
    right: -2px;
    width: 20px;
    height: 14px;
    font-size: 9px;
}

.menuSelectable {
    width: 250px;
    transition: all 0.2s;
    border-radius: 15px;
    padding: 10px;
}

.menuSelectable:hover {
    background-color: #f9f9f9;
}
</style>
