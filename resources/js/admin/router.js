import Vue from "vue"
import VueRouter from "vue-router"
import config from "@admin/config"
import NotFound from "@admin/modules/errors/notfound.vue"

Vue.use(VueRouter)

// Modules Routes
import auth from "@admin/modules/auth/routes"
import dashboard from "@admin/modules/dashboard/routes"
import users from "@admin/modules/users/routes"
import blog from "@admin/modules/blog/routes"
import gallery from "@admin/modules/gallery/routes"
import configuration from "@admin/modules/configuration/routes"
import errors from "@admin/modules/errors/routes"
import test from "@admin/modules/test/routes"

const router = new VueRouter({
    mode: "history", // removes # (hashtag) from url
    base: "/admin",
    // fallback: true, // router should fallback to hash (#) mode when the browser does not support history.pushState
    routes: [
        {
            path: "/",
            name: "Home",
            redirect: "/dashboard/index"
        },
        ...auth,
        ...dashboard,
        ...users,
        ...blog,
        ...gallery,
        ...configuration,
        ...errors,
        ...test,
        {
            path: "/:catchAll(.*)",
            component: NotFound,
            name: "Not Found"
        }
    ],
    scrollBehavior() {
        return { x: 0, y: 0 }
    }
})

// Check Token to Authenticated Routes
router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        if (localStorage.getItem("admin_access_token") == null) {
            next({ name: config.named_routes.auth.login })
        } else {
            next()
        }
    } else {
        next()
    }
})

// Redirect To Home Landing Route if user is Authenticated
router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.forAuth)) {
        if (localStorage.getItem("admin_access_token") == null) {
            next()
        } else {
            next({ name: config.named_routes.dashboard })
        }
    } else {
        next()
    }
})

export default router
