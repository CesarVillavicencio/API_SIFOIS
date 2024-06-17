<template>
    <div class="container is-fluid">
        <div
            class="is-flex is-justify-content-center is-align-content-center is-align-items-center"
            style="height: 85vh; filter: grayscale(1)">
            <img style="width: 40%" :src="isAssetFile($appLogo)" />
        </div>
    </div>
</template>

<script>
import { isAssetFile } from "@admin/tools"

export default {
    methods: {
        isAssetFile: isAssetFile
    }
}
</script>
