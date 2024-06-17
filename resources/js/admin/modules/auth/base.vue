<template>
    <div class="content-wrapper">
        <transition name="fade" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
import { mapActions } from "pinia"
import useAuthStore from "./store"

export default {
    mounted() {
        this.getAuthBackground()
    },
    methods: {
        ...mapActions(useAuthStore, ["getAuthBackground"])
    }
}
</script>
