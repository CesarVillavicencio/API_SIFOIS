import named_routes from "@admin/helpers/named_routes"
import sidemenu_data from "@admin/helpers/sidemenu_data"

export default {
    token: document.head.querySelector('meta[name="csrf-token"]').getAttribute("content"),
    publicUrl: document.head.querySelector('meta[name="public_url"]').getAttribute("content"),
    appName: import.meta.env.VITE_APP_NAME,
    appBaseUrl: "/admin",
    appEnv: import.meta.env.VITE_APP_ENV,
    maxFileSize: import.meta.env.VITE_MAX_FILE_SIZE,
    avatar: { default: import.meta.env.VITE_DEFAULT_AVATAR_URL },
    previewImage: import.meta.env.VITE_PREVIEW_IMAGE,
    noImagePlaceholder: "images/preparation/no_image_placeholder.jpg",
    appLogo: import.meta.env.VITE_APP_LOGO,
    appEnvString: import.meta.env.VITE_APP_STRING_ENV,
    appVersion: import.meta.env.VITE_APP_VERSION,

    // Named Routes
    ...named_routes,

    // SideMenu Routes Data
    sideMenuData: sidemenu_data
}
