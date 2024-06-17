<template>
    <div class="container is-fluid">
        <transition :name="app_options.transition" mode="out-in">
            <router-view></router-view>
        </transition>
    </div>
</template>

<script>
import { mapState } from "pinia"
import useAuthStore from "@admin/modules/auth/store"

export default {
    computed: {
        ...mapState(useAuthStore, ["app_options"])
    }
}
</script>
