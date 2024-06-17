<template>
    <div class="box">
        <b-field label="Transición">
            <b-select
                v-model="configuration.transition"
                size="is-small"
                expanded
                @change.native="updateEffectsOnChange">
                <option v-for="(option, i) in transitions" :key="i" :value="option.value">
                    {{ option.text }}
                </option>
            </b-select>
        </b-field>

        <div style="width: 100%; height: 50px">
            <transition :name="configuration.transition" appear mode="out-in">
                <div v-if="changedInput" class="buttons is-justify-content-center">
                    <b-button type="is-primary" icon-left="user" size="is-small"> Ejemplo </b-button>
                </div>
            </transition>
        </div>

        <div class="buttons is-justify-content-flex-end">
            <b-button type="is-primary" icon-left="sync-alt" size="is-small" @click="update"> Actualizar </b-button>
            <b-button type="is-info" size="is-small" @click="setDefaultEffect"> Predeterminado </b-button>
        </div>
    </div>
</template>

<script>
import { storeToRefs } from "pinia"
import useConfigurationStore from "./store"
import useAuthStore from "@admin/modules/auth/store"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

const sleep = (ms) => {
    return new Promise((resolve) => setTimeout(resolve, ms))
}

export default {
    mixins: [handleErrorMessages, toastNotifications],
    setup() {
        const store = useConfigurationStore()
        const authStore = useAuthStore()
        const { configuration } = storeToRefs(store)

        const updateEffects = () => store.updateEffects()
        const setAppOptionsTransition = (value) => (authStore.app_options.transition = value)

        return {
            configuration,
            transitions: store.transitions,
            updateEffects,
            setAppOptionsTransition
        }
    },
    data() {
        return {
            changedInput: true
        }
    },
    methods: {
        update() {
            this.updateEffects()
                .then((configuration) => {
                    this.successToast("Efectos de transición actualizados!")
                    this.setAppOptionsTransition(configuration.options.transition)
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        },
        setDefaultEffect() {
            this.configuration.transition = "fade"
            this.setAppOptionsTransition("fade")
            this.update()
        },
        async updateEffectsOnChange() {
            this.changedInput = false
            this.setAppOptionsTransition(this.configuration.transition)
            await sleep(500)
            this.changedInput = true
        }
    }
}
</script>
