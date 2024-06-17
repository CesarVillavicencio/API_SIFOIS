import { defineStore } from "pinia"

const defaultLogin = () => {
    return {
        username: "",
        password: ""
    }
}

const defaultUserData = () => {
    return {
        id: 0,
        name: "",
        lastname: "",
        avatar: "",
        email: "",
        type: "",
        created: "",
        new_notifications: 0
    }
}

export default defineStore("authentication", {
    state: () => ({
        user_data: defaultUserData(),
        app_options: null,
        user_types: null,
        is_user_authenticated: false,
        token: localStorage.getItem("admin_access_token") || null,
        loading: false,
        loginData: defaultLogin(),
        errors: [],
        auth_background: null
    }),
    actions: {
        setToken(token) {
            this.token = token
            localStorage.setItem("admin_access_token", token)
        },
        destroyToken() {
            this.token = null
            localStorage.removeItem("admin_access_token")
        },
        check() {
            this.loading = true
            return window.axios
                .get("/user")
                .then((res) => {
                    this.user_data = res.data.user
                    this.app_options = res.data.options
                    this.user_types = res.data.user_types
                    this.is_user_authenticated = true
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        login() {
            this.loading = true
            this.errors = []
            return window.axios
                .post("/login", this.loginData)
                .then((res) => {
                    this.setToken(res.data.token)
                    this.user_data = res.data.user
                    this.app_options = res.data.options
                    this.user_types = res.data.user_types
                    this.is_user_authenticated = true
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    this.errors = error.response.data.errors
                    throw error
                })
        },
        logout() {
            this.loading = true
            return window.axios
                .post("/logout")
                .then((res) => {
                    this.destroyToken()
                    this.user_data = defaultUserData()
                    this.is_user_authenticated = false
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        cleanLogin() {
            this.loginData = defaultLogin()
            this.errors = []
        },
        devLoginAsRandomAdmin(type = "admin") {
            // Only on Development Env
            this.loading = true
            this.errors = []
            return window.axios
                .post("/login-random-admin", { type: type })
                .then((res) => {
                    this.setToken(res.data.token)
                    this.user_data = res.data.user
                    this.app_options = res.data.options
                    this.user_types = res.data.user_types
                    this.is_user_authenticated = true
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    this.errors = error.response.data.errors
                    throw error
                })
        },
        addUserNewNotifications(num) {
            this.user_data.new_notifications += num
        },
        setUserNewNotifications(num) {
            this.user_data.new_notifications = num
        },
        setUserData(data) {
            if (!data) return
            this.user_data = data.user
            this.app_options = data.options
            this.user_types = data.user_types
        },
        getAuthBackground() {
            if (this.auth_background) return
            return window.axios
                .get("/background")
                .then((res) => {
                    this.auth_background = res.data.login_background_url
                    return res.data
                })
                .catch((error) => {
                    throw error
                })
        }
    }
})
