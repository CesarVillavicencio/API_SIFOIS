<template>
    <div class="box">
        <b-field label="Atajos">
            <b-taginput
                v-model="configuration.shortcuts"
                ellipsis
                maxtags="5"
                :data="filteredRoutes"
                open-on-focus
                autocomplete
                field="name"
                icon="caret-square-right"
                placeholder="Agregar atajo"
                aria-close-label="Borrar atajo">
            </b-taginput>
        </b-field>

        <br /><br />

        <div class="buttons is-justify-content-flex-end">
            <b-button type="is-primary" icon-left="sync-alt" @click="update"> Actualizar </b-button>
        </div>
    </div>
</template>

<script>
import { computed } from "vue"
import { storeToRefs } from "pinia"
import useConfigurationStore from "./store"
import useAuthStore from "@admin/modules/auth/store"
import useSystemStore from "@admin/components/store"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    mixins: [handleErrorMessages, toastNotifications],
    setup() {
        const store = useConfigurationStore()
        const authStore = useAuthStore()
        const systemStore = useSystemStore()
        const { configuration } = storeToRefs(store)

        const updateShortcuts = () => store.updateShortcuts()
        const setAppOptionsShortcuts = (value) => (authStore.app_options.shortcuts = value)

        const filteredRoutes = computed(() => {
            var routes = []

            systemStore.sidebar_menu.forEach((menu) => {
                menu.modules.forEach((mod) => {
                    routes.push({
                        name: mod.name,
                        route_name: mod.route_name
                    })
                })
            })

            return routes
        })

        return {
            configuration,
            filteredRoutes,
            updateShortcuts,
            setAppOptionsShortcuts
        }
    },
    methods: {
        update() {
            this.updateShortcuts()
                .then((configuration) => {
                    this.successToast("Atajos actualizados!")
                    this.setAppOptionsShortcuts(configuration.options.shortcuts)
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        }
    }
}
</script>
