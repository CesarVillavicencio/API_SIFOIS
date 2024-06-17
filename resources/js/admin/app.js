import Vue from "vue"
import router from "@admin/router"
import config from "@admin/config"

// Vue Pinia
import { createPinia, PiniaVuePlugin } from "pinia"
const pinia = createPinia()
Vue.use(PiniaVuePlugin)

// Auth Store & System Store
import useAuthStore from "@admin/modules/auth/store"

// ***********************
// ***** Admin Sass ******
// ***********************
import "@/sass/admin.scss"

// ****************************
// ***** Vue Fontawesome ******
// ****************************
import "@admin/fontawesome"

// ******************
// ***** Buefy ******
// ******************
import Buefy from "buefy"
Vue.use(Buefy, {
    defaultIconPack: "fas",
    defaultIconComponent: "font-awesome-icon",
    defaultLocale: ["es-MX"],
    defaultToastDuration: 5000
})

// Toast Messages Outside Vue Instances
import openToast from "@admin/helpers/openToast"

// ******************
// ***** Axios ******
// ******************
import axios from "axios"
axios.defaults.baseURL = config.publicUrl + "admin"
axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest"

// Check for Token
axios.interceptors.request.use((req) => {
    if (localStorage.getItem("admin_access_token") != null) {
        req.headers.authorization = "Bearer " + localStorage.getItem("admin_access_token")
    }
    return req
})

// Check for blocked user response
axios.interceptors.response.use(
    (res) => res,
    (error) => {
        /*if (error.response.status == 403) {
            let reason = error.response.data["server_error_reason"] || null
            if (reason && reason == "blocked admin user") {
                const authStore = useAuthStore()
                authStore.setBlockedUser(error.response.data["blocked_at"])
                authStore.destroyToken()
            }
        }*/

        if (error.response.status == 401) {
            const noToastRoutes = ["/", "/auth/login"]
            if (!noToastRoutes.includes(router.currentRoute.path)) {
                openToast("Tu sesión ha caducado...", "is-warning", "is-bottom-left")
                router.push({ name: "Login" })
            }

            // window.location = config.publicUrl
        }

        return Promise.reject(error)
    }
)

window.axios = axios

// *****************************************
// ***** Global Dayjs + Dayjs Locales ******
// *****************************************
import dayjs from "./dayjs"
Vue.prototype.$dayjs = dayjs

// ****************************
// ***** Set Global Vars ******
// ****************************
Vue.prototype.$namedRoutes = config.named_routes
Vue.prototype.$publicUrl = config.publicUrl
Vue.prototype.$appName = config.appName
Vue.prototype.$appEnv = config.appEnv
Vue.prototype.$appBaseUrl = config.appBaseUrl
Vue.prototype.$defaultAvatar = config.avatar.default
Vue.prototype.$previewImage = config.previewImage
Vue.prototype.$maxFileSize = config.maxFileSize
Vue.prototype.$noImagePlaceholder = config.noImagePlaceholder
Vue.prototype.$appLogo = config.appLogo
Vue.prototype.$appEnvString = config.appEnvString
Vue.prototype.$appVersion = config.appVersion
Vue.prototype.$sideMenuData = config.sideMenuData

// Vue Config
Vue.config.productionTip = false

// Base Module
import baseapp from "@admin/components/baseapp.vue"
import fitimage from "@admin/components/fitimage.vue"
Vue.component("fitimage", fitimage)

// Init Check
let checkAuthData = null
const checkAuth = () => {
    window.axios
        .get("/user")
        .then((res) => {
            document.getElementById("pageloader").classList.remove("is-active")
            checkAuthData = res.data
            initializeVueApp()
        })
        .catch(() => {
            document.getElementById("pageloader").classList.remove("is-active")
            localStorage.removeItem("admin_access_token")
            initializeVueApp()
        })
}

checkAuth()

// Vue Init Function
function initializeVueApp() {
    new Vue({
        router,
        pinia,
        setup() {
            // Load CheckAuthData
            const authStore = useAuthStore()
            authStore.setUserData(checkAuthData)

            return {}
        },
        render: (h) => h(baseapp)
    }).$mount("#app")
}
