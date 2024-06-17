<template>
    <div class="admin_start">
        <!-- Mobile SideBar Menu & Mobile Menu -->
        <mobilesidebar />
        <mobilemenu />

        <div v-if="hasAdminLayout" class="columns is-gapless mb-0">
            <div class="column hero is-fullheight is-hidden-touch" :class="isSideBarCompact">
                <sidebar />
            </div>
            <div class="column">
                <navtop />
                <router-view />
                <footbot />
            </div>
        </div>
        <div v-else class="no_admin_layout">
            <router-view />
        </div>

        <scrolltop />
    </div>
</template>

<script>
import { mapActions, mapState } from "pinia"
import useSystemStore from "./store"
import navtop from "./layout/navtop.vue"
import sidebar from "./layout/sidebar.vue"
import footbot from "./layout/footbot.vue"
import mobilesidebar from "./layout/mobile_sidebar.vue"
import mobilemenu from "./layout/mobile_menu.vue"
import scrolltop from "./scrolltop.vue"

export default {
    components: {
        navtop,
        sidebar,
        footbot,
        mobilesidebar,
        mobilemenu,
        scrolltop
    },
    computed: {
        ...mapState(useSystemStore, ["sidebar_compact"]),
        isSideBarCompact() {
            return this.sidebar_compact ? "is-1 compact" : "is-2"
        },
        hasAdminLayout() {
            return !this.$namedRoutes.no_layout_routes.includes(this.$route.name)
        }
    },
    created() {
        window.addEventListener("resize", this.updateSceenSizeVar)
        window.addEventListener("scroll", this.updateScrollScrollVars)
    },
    destroyed() {
        window.removeEventListener("resize", this.updateSceenSizeVar)
        window.removeEventListener("scroll", this.updateScrollScrollVars)
    },
    methods: {
        ...mapActions(useSystemStore, ["setWindowSize", "setWindowScroll"]),
        updateSceenSizeVar() {
            this.setWindowSize(window.innerWidth, window.innerHeight)
        },
        updateScrollScrollVars() {
            this.setWindowScroll(window.scrollY, document.documentElement.scrollTop)
        }
    }
}
</script>

<style scoped>
.compact {
    width: 75px !important;
}
</style>
