<template>
    <div class="box">
        <b-field label="Buscador en la barra de navegación">
            <b-select v-model="configuration.header_search" expanded>
                <option v-for="(option, i) in getHeaderSearchOptions" :key="i" :value="option.value">
                    {{ option.text }}
                </option>
            </b-select>
        </b-field>

        <div class="buttons is-justify-content-flex-end">
            <b-button type="is-primary" icon-left="sync-alt" @click="update"> Actualizar </b-button>
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

        const updateHeaderSearch = () => store.updateHeaderSearch()
        const setAppOptionsHeaderSearch = (value) => (authStore.app_options.header_search = value)

        return {
            configuration,
            updateHeaderSearch,
            setAppOptionsHeaderSearch
        }
    },
    computed: {
        getHeaderSearchOptions() {
            return [
                { text: "Si", value: true },
                { text: "No", value: false }
            ]
        }
    },
    methods: {
        update() {
            this.updateHeaderSearch()
                .then((configuration) => {
                    this.successToast("Buscador en la barra de navegación actualizado!")
                    this.setAppOptionsHeaderSearch(configuration.options.header_search)
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        }
    }
}
</script>
