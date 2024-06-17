<template>
    <div class="box">
        <b-field label="Color de fondo de barra de navegación">
            <b-select
                v-model="configuration.navbar_back_color"
                size="is-small"
                expanded
                @change.native="updateColorsOnSidebar">
                <option v-for="(option, i) in navbarBackColors" :key="i" :value="option.value">
                    {{ option.text }}
                </option>
            </b-select>
        </b-field>

        <b-field label="Color de fondo de barra lateral">
            <b-select
                v-model="configuration.sidebar_back_color"
                size="is-small"
                expanded
                @change.native="updateColorsOnSidebar">
                <option v-for="(option, i) in sidebarBackColors" :key="i" :value="option.value">
                    {{ option.text }}
                </option>
            </b-select>
        </b-field>

        <div class="buttons is-justify-content-flex-end">
            <b-button type="is-primary" icon-left="sync-alt" size="is-small" @click="update"> Actualizar </b-button>
            <b-button type="is-info" size="is-small" @click="setDefaultColors"> Predeterminado </b-button>
        </div>
    </div>
</template>

<script>
import { storeToRefs } from "pinia"
import useConfigurationStore from "./store"
import useAuthStore from "@admin/modules/auth/store"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    mixins: [handleErrorMessages, toastNotifications],

    setup() {
        const store = useConfigurationStore()
        const authStore = useAuthStore()
        const { configuration } = storeToRefs(store)

        const updateColors = () => store.updateColors()
        const setAppOptionsNavbarBackColor = (value) => (authStore.app_options.navbar_back_color = value)
        const setAppOptionsSidebarBackColor = (value) => (authStore.app_options.sidebar_back_color = value)

        return {
            configuration,
            sidebarBackColors: store.sidebar_back_color,
            navbarBackColors: store.navbar_back_color,
            updateColors,
            setAppOptionsNavbarBackColor,
            setAppOptionsSidebarBackColor
        }
    },
    methods: {
        update() {
            this.updateColors()
                .then((configuration) => {
                    this.successToast("Colores actualizados!")
                    this.setAppOptionsNavbarBackColor(configuration.options.navbar_back_color)
                    this.setAppOptionsSidebarBackColor(configuration.options.sidebar_back_color)
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        },
        setDefaultColors() {
            this.configuration.navbar_back_color = "is-light"
            this.configuration.sidebar_back_color = "has-background-light"
            this.update()
        },
        updateColorsOnSidebar() {
            this.setAppOptionsNavbarBackColor(this.configuration.navbar_back_color)
            this.setAppOptionsSidebarBackColor(this.configuration.sidebar_back_color)
        }
    }
}
</script>
