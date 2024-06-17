import { defineStore } from "pinia"

const defaultConfiguration = () => {
    return {
        navbar_back_color: "is-light",
        sidebar_back_color: "has-background-light",
        login_background_url: null,
        contact_email: "",
        front_site_up: true,
        header_search: true,
        transition: "fade",
        language: "es",
        shortcuts: [],
        admin_logo: null
    }
}

export default defineStore("configuration", {
    state: () => ({
        loading: false,
        configuration: defaultConfiguration(),
        loaded_configuration: false,
        contact_errors: [],
        sidebar_back_color: [
            { text: "White", value: "has-background-white" },
            { text: "Black", value: "has-background-black" },
            { text: "Light", value: "has-background-light" },
            { text: "Dark", value: "has-background-dark" },
            { text: "Primary", value: "has-background-primary" },
            { text: "Link", value: "has-background-link" },
            { text: "Info", value: "has-background-info" },
            { text: "Success", value: "has-background-success" },
            { text: "Warning", value: "has-background-warning" },
            { text: "Danger", value: "has-background-danger" },
            { text: "Black-Bis", value: "has-background-black-bis" },
            { text: "Black-Ter", value: "has-background-black-ter" },
            { text: "Grey-Darker", value: "has-background-grey-darker" },
            { text: "Grey-Dark", value: "has-background-grey-dark" },
            { text: "Grey", value: "has-background-grey" },
            { text: "Grey-Light", value: "has-background-grey-light" },
            { text: "Grey-Lighter", value: "has-background-grey-lighter" },
            { text: "White-Ter", value: "has-background-white-ter" },
            { text: "White-Bis", value: "has-background-white-bis" },
            { text: "Primary-Light", value: "has-background-primary-light" },
            { text: "Link-Light", value: "has-background-link-light" },
            { text: "Info-Light", value: "has-background-info-light" },
            { text: "Success-Light", value: "has-background-success-light" },
            { text: "Warning-Light", value: "has-background-warning-light" },
            { text: "Danger-Light", value: "has-background-danger-light" },
            { text: "Primary-Dark", value: "has-background-primary-dark" },
            { text: "Success-Dark", value: "has-background-success-dark" },
            { text: "Warning-Dark", value: "has-background-warning-dark" },
            { text: "Danger-Dark", value: "has-background-danger-dark" }
        ],
        navbar_back_color: [
            { text: "Primary", value: "is-primary" },
            { text: "Link", value: "is-link" },
            { text: "Info", value: "is-info" },
            { text: "Success", value: "is-success" },
            { text: "Warning", value: "is-warning" },
            { text: "Danger", value: "is-danger" },
            { text: "Black", value: "is-black" },
            { text: "Dark", value: "is-dark" },
            { text: "Light", value: "is-light" },
            { text: "White", value: "is-white" }
        ],
        transitions: [
            { text: "Bounce", value: "bounce" },
            { text: "Bounce Down", value: "bounceDown" },
            { text: "Bounce Left", value: "bounceLeft" },
            { text: "Bounce Right", value: "bounceRight" },
            { text: "Bounce Up", value: "bounceUp" },
            { text: "Fade", value: "fade" },
            { text: "Fade Down", value: "fadeDown" },
            { text: "Fade Down Big", value: "fadeDownBig" },
            { text: "Fade Left", value: "fadeLeft" },
            { text: "Fade Left Big", value: "fadeLeftBig" },
            { text: "Fade Right", value: "fadeRight" },
            { text: "Fade Right Big", value: "fadeRightBig" },
            { text: "Fade Up", value: "fadeUp" },
            { text: "Fade Up Big", value: "fadeUpBig" },
            { text: "Flip", value: "flip" },
            { text: "Flip X", value: "flipX" },
            { text: "Flip Y", value: "flipY" },
            { text: "Rotate", value: "rotate" },
            { text: "Rotate Down Left", value: "rotateDownLeft" },
            { text: "Rotate Down Right", value: "rotateDownRight" },
            { text: "Rotate Up Left", value: "rotateUpLeft" },
            { text: "Rotate Up Right", value: "rotateUpRight" },
            { text: "Slide Down", value: "slideDown" },
            { text: "Slide Left", value: "slideLeft" },
            { text: "slide Right", value: "slideRight" },
            { text: "Slide Up", value: "slideUp" },
            { text: "Zoom", value: "zoom" },
            { text: "Zoom Down", value: "zoomDown" },
            { text: "Zoom Left", value: "zoomLeft" },
            { text: "Zoom Right", value: "zoomRight" },
            { text: "Zoom Up", value: "zoomUp" },
            { text: "Light Speed", value: "lightSpeed" }
        ]
    }),
    getters: {
        getColors: (state) => {
            return {
                navbar_back_color: state.configuration.navbar_back_color,
                sidebar_back_color: state.configuration.sidebar_back_color
            }
        },
        hasLoginBackgroundUrl: (state) => (state.configuration.login_background_url ? true : false),
        hasAdminLogo: (state) => (state.configuration.admin_logo ? true : false)
    },
    actions: {
        getConfiguration() {
            this.loading = true
            return window.axios
                .get("/configuration/get")
                .then((res) => {
                    this.configuration = res.data
                    this.loaded_configuration = true
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        updateContactEmail() {
            this.loading = true
            this.contact_errors = []
            return window.axios
                .post("/configuration/contact", {
                    email: this.configuration.contact_email
                })
                .then((res) => {
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    this.contact_errors = error.response.data.errors
                    throw error
                })
        },
        updateFrontSiteUp() {
            this.loading = true
            return window.axios
                .post("/configuration/siteup", {
                    front_site_up: this.configuration.front_site_up
                })
                .then((res) => {
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        updateHeaderSearch() {
            this.loading = true
            return window.axios
                .post("/configuration/headsearch", {
                    header_search: this.configuration.header_search
                })
                .then((res) => {
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        updateColors() {
            this.loading = true
            return window.axios
                .post("/configuration/colors", this.getColors)
                .then((res) => {
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        updateEffects() {
            this.loading = true
            return window.axios
                .post("/configuration/effects", {
                    transition: this.configuration.transition
                })
                .then((res) => {
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        updateShortcuts() {
            this.loading = true
            return window.axios
                .post("/configuration/shortcuts", {
                    shortcuts: this.configuration.shortcuts
                })
                .then((res) => {
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        updateLanguage() {
            this.loading = true
            return window.axios
                .post("/configuration/language", {
                    language: this.configuration.language
                })
                .then((res) => {
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        uploadLoginBackgroundUrl(file) {
            this.loading = true
            var form = new FormData()
            form.append("image", file)
            return window.axios
                .post("/configuration/background", form, {
                    headers: { "Content-Type": "multipart/form-data" }
                })
                .then((res) => {
                    this.loading = false
                    this.configuration.login_background_url =
                        res.data.options.login_background_url + "?help=" + new Date().getTime()
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        uploadAdminLogo(file) {
            this.loading = true
            var form = new FormData()
            form.append("image", file)
            return window.axios
                .post("/configuration/logo", form, {
                    headers: { "Content-Type": "multipart/form-data" }
                })
                .then((res) => {
                    this.loading = false
                    this.configuration.admin_logo = res.data
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        resetLoginBackgroundUrl() {
            this.loading = true
            return window.axios
                .post("/configuration/background/reset")
                .then((res) => {
                    this.configuration.login_background_url = null
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        }
    }
})
