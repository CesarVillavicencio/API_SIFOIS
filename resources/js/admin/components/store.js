import { defineStore } from "pinia"

export default defineStore("system", {
    state: () => ({
        window_size: {
            inner_width: window.innerWidth,
            inner_height: window.innerHeight
        },
        window_scroll: {
            scrollY: window.scrollY,
            pageYOffset: document.documentElement.scrollTop
        },
        sidebar_compact: false,
        mobile_sidebar_open: false,
        mobile_menu_open: false,
        notifications: [],
        loading_notifications: false
    }),
    getters: {
        isWindowWidth: (state) => (size, compare) => {
            // compare = less || more
            if (compare == "less") return state.window_size.inner_width <= size
            return state.window_size.inner_height >= size
        }
    },
    actions: {
        toggleMobileSideBar() {
            this.mobile_sidebar_open = !this.mobile_sidebar_open
        },
        toggleMobileMenu() {
            this.mobile_menu_open = !this.mobile_menu_open
        },
        toggleSideBarCompact() {
            this.sidebar_compact = !this.sidebar_compact
        },
        setWindowSize(innerWidth, innerHeight) {
            this.window_size = {
                inner_width: innerWidth,
                inner_height: innerHeight
            }
        },
        setWindowScroll(scrollY, pageYOffset) {
            this.window_scroll = {
                scrollY: scrollY,
                pageYOffset: pageYOffset
            }
        },
        getUserNotifications() {
            this.loading_notifications = true

            this.notifications = []
            this.loading_notifications = false

            return this.notifications

            /*return window.axios
                .get("/notifications/get")
                .then((res) => {
                    this.notifications = res.data
                    this.loading_notifications = false
                    return res.data
                })
                .catch((error) => {
                    this.loading_notifications = false
                    throw error
                })*/
        },
        pushNotification(notification) {
            this.notifications.push(notification)
        }
    }
})
