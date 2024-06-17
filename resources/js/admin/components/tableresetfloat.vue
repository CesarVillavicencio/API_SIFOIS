<template>
    <div v-show="isVisible" class="bottom-right" title="Cerrar Detalles">
        <b-button size="is-small" :focused="false" icon-left="compress-alt" @click="scrollTop"> </b-button>
    </div>
</template>

<script>
import { mapState } from "pinia"
import useSystemStore from "./store"

export default {
    computed: {
        ...mapState(useSystemStore, ["window_scroll"]),
        isVisible() {
            return this.window_scroll.scrollY > 150
        }
    },
    methods: {
        scrollTop() {
            this.$emit("compress")
            this.intervalId = setInterval(() => {
                if (this.window_scroll.pageYOffset === 0) {
                    clearInterval(this.intervalId)
                }
                window.scroll(0, this.window_scroll.pageYOffset - 100)
            }, 20)
        }
    }
}
</script>

<style scoped>
.bottom-right {
    position: fixed;
    bottom: 60px;
    right: 20px;
}
</style>
