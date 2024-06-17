<template>
    <aside class="menu sidebar_styled p-4 is-hidden-touch" :class="setSideBarCustomClasses">
        <div
            class="is-flex is-justify-content-center is-align-items-center is-flex-wrap-wrap mb-4"
            @click="goDashboard">
            <figure class="image">
                <img v-if="!sidebar_compact" style="width: 150px; height: auto" :src="isAssetFile($appLogo)" />
                <img v-else style="width: 150px; height: auto" :src="isAssetFile($appLogo)" />
            </figure>
        </div>

        <!-- Menus -->
        <div v-for="(menu, i) in getSideBarMenu" :key="i" class="mb-2">
            <p v-if="!sidebar_compact && menu.show" class="menu-label mt-4">
                {{ menu.name }}
            </p>

            <ul class="menu-list">
                <li v-for="(submenu, j) in menu.modules" :key="j">
                    <a
                        class="link_module"
                        :title="submenu.name"
                        :class="checkActiveRoute(submenu.routes_names)"
                        @click="goRoute(submenu.route_name)">
                        <font-awesome-icon :icon="submenu.icon" />
                        <span v-if="!sidebar_compact">
                            {{ submenu.name }}
                        </span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script>
import { mapState } from "pinia"
import useSystemStore from "@admin/components/store"
import useAuthStore from "@admin/modules/auth/store"
import { isAssetFile } from "@admin/tools"

export default {
    computed: {
        ...mapState(useAuthStore, ["app_options"]),
        ...mapState(useSystemStore, ["sidebar_compact"]),
        getSideBarMenu() {
            // Object.values(this.$sideMenuData)
            let sideMenu = [],
                modules = []

            this.$sideMenuData.forEach((m) => {
                modules = []

                m.modules.forEach((s) => {
                    modules.push(s)
                })

                sideMenu.push({
                    name: m.name,
                    modules: modules,
                    show: modules.length != 0
                })
            })

            return sideMenu
        },
        setSideBarCustomClasses() {
            let classes = ""
            if (this.sidebar_compact) classes += "compact "
            classes += this.app_options.sidebar_back_color
            return classes
        },
        isSideBarCompact() {
            return this.sidebar_compact ? "is-1 compact" : "is-2"
        }
    },
    methods: {
        checkActiveRoute(routes_names) {
            return routes_names.includes(this.$route.name) ? "is-active" : ""
        },
        goDashboard() {
            this.$router.push({ name: this.$namedRoutes.dashboard })
        },
        goRoute(route_name) {
            this.$router.push({ name: route_name }).catch(() => {})
        },
        isAssetFile: isAssetFile
    }
}
</script>

<style scoped>
.sidebar_styled {
    -webkit-box-shadow: 0 0 15px 0 rgba(34, 41, 47, 0.05);
    box-shadow: 0 0 15px 0 rgba(34, 41, 47, 0.05);
    height: 100%;
}

.menu-list a.is-active {
    box-shadow: 0 0px 15px 4px rgba(113, 111, 111, 0.37);
}

.logo_image {
    box-shadow: 0 0px 15px 4px rgba(113, 111, 111, 0.37);
}

.link_module {
    -webkit-transition: -webkit-transform 0.25s ease;
    transition: -webkit-transform 0.25s ease;
    transition: transform 0.25s ease;
    transition: transform 0.25s ease, -webkit-transform 0.25s ease;
}

.link_module:hover {
    -webkit-transform: translateX(5px);
    transform: translateX(5px);
}

.compact {
    width: 75px;
}
</style>
