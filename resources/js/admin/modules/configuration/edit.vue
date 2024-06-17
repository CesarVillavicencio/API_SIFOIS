<template>
    <div class="configuration_zone is-relative">
        <b-loading v-model="loading" :is-full-page="false" />

        <h2 class="title mb-6">
            <font-awesome-icon :icon="['fa', 'cogs']" />
            Configuración
        </h2>

        <div v-if="loaded_configuration" class="columns is-multiline is-mobile">
            <div class="column">
                <contact />
                <colors />
            </div>

            <div class="column">
                <frontsiteup />
                <effects />
                <backlogin />
            </div>
        </div>
    </div>
</template>

<script>
import { onMounted } from "vue"
import { storeToRefs } from "pinia"
import useConfigurationStore from "./store"
import { onBeforeRouteLeave } from "vue-router/composables"
import contact from "./contact.vue"
import frontsiteup from "./frontsiteup.vue"
import colors from "./colors.vue"
import effects from "./effects.vue"
import backlogin from "./backlogin.vue"

export default {
    components: {
        contact,
        frontsiteup,
        colors,
        effects,
        backlogin
    },
    setup() {
        // const router = useRoute()
        const store = useConfigurationStore()
        const { loading, loaded_configuration } = storeToRefs(store)

        onBeforeRouteLeave((to, from, next) => {
            store.$reset()
            next()
        })

        onMounted(() => {
            store.getConfiguration()
        })

        return {
            loading,
            loaded_configuration
        }
    }
}
</script>
