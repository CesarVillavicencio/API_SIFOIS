<template>
    <b-sidebar v-model="mobile_sidebar_open" type="is-light" fullheight fullwidth left>
        <div class="p-1">
            <!-- 
            <div style="position: absolute; top: 10px; right: 10px;">
                <b-button type="is-danger" icon-right="times-circle" @click="closeMobileSidebar" />
            </div>
            -->

            <div class="is-flex is-align-items-center is-flex-wrap-wrap mb-4" @click="goDashboard">
                <figure class="image">
                    <img class="" style="width: 150px" :src="isAssetFile($appLogo)" />
                </figure>

                <div class="ml-2">
                    <b>{{ $appName }}</b>
                </div>
            </div>

            <!-- Menus -->
            <b-menu>
                <b-menu-list v-for="(menu, i) in getSideBarMenu" :key="i" :label="menu.name">
                    <b-menu-item
                        v-for="(submenu, j) in menu.modules"
                        :key="j"
                        :label="submenu.name"
                        :icon="submenu.icon[1]"
                        :active="checkActiveRoute(submenu.routes_names)"
                        @click="goRoute(submenu.route_name)">
                    </b-menu-item>
                </b-menu-list>

                <!-- 
                <b-menu-list>
                    <b-menu-item label="Cerrar" icon="times-circle" :active="false" @click="closeMobileSidebar" />
                </b-menu-list>
                -->
            </b-menu>
        </div>
    </b-sidebar>
</template>

<script>
import { mapWritableState } from "pinia"
import useSystemStore from "@admin/components/store"
import { isAssetFile } from "@admin/tools"

export default {
    computed: {
        ...mapWritableState(useSystemStore, ["mobile_sidebar_open"]),
        getSideBarMenu() {
            // Object.values(this.$sideMenuData)
            let sideMenu = [],
                modules = []

            this.$sideMenuData.forEach((m) => {
                modules = []

                m.modules.forEach((s) => {
                    // Future: You can do checks for privileges or permissions here
                    modules.push(s)
                })

                if (modules.length != 0) {
                    sideMenu.push({
                        name: m.name,
                        modules: modules
                    })
                }
            })

            return sideMenu
        }
    },
    methods: {
        checkActiveRoute(routes_names) {
            return routes_names.includes(this.$route.name)
        },
        goDashboard() {
            this.$router.push({ name: "Dashboard Index" })
        },
        goRoute(route_name) {
            this.$router.push({ name: route_name })
            this.mobile_sidebar_open = false
        },
        closeMobileSidebar() {
            this.mobile_sidebar_open = false
        },
        isAssetFile: isAssetFile
    }
}
</script>
