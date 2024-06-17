<template>
    <footer class="main-footer m-4">
        <div class="columns is-mobile">
            <div class="column">
                <strong
                    >Copyright © 2024 <a :href="$publicUrl" target="_blank">{{ $appName + " Admin" }}</a
                    >.</strong
                >
            </div>
            <div class="column">
                <div class="is-pulled-right">
                    <b>Version {{ $appVersion }} </b>
                    <font-awesome-icon :icon="['fa', 'heart']" :style="{ color: 'red' }" />
                </div>
            </div>
        </div>
    </footer>
</template>

<script>
export default {
    name: "Footbot"
}
</script>
