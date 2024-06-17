<template>
    <div :class="containerClass" :style="containerStyle">
        <figure v-if="img != null" class="image" :class="ratio">
            <img v-if="!isEmpty(img)" :class="getClasses" :src="getImg" loading="lazy" @error="replaceByDefault" />
            <img v-else :src="isAssetFile($noImagePlaceholder)" loading="lazy" @error="replaceByDefault" />
        </figure>
        <figure v-else class="image" :class="ratio">
            <img :src="isAssetFile($noImagePlaceholder)" loading="lazy" @error="replaceByDefault" />
        </figure>
    </div>
</template>

<script>
import { isStorageFile, isAssetFile, isEmpty, removeDoubleSlashFromUrl } from "@admin/tools"

export default {
    props: {
        img: {
            type: String,
            default: null
        },
        ratio: {
            type: String,
            default: "is-4by3"
        },
        imgclasses: {
            type: String,
            default: ""
        },
        containerClass: {
            type: String,
            default: "maxwidth"
        },
        containerStyle: {
            type: String,
            default: ""
        },
        isAsset: {
            type: Boolean,
            default: false
        }
    },
    computed: {
        getClasses() {
            return "imgobjectfit " + this.imgclasses
        },
        getImg() {
            if (this.img == null) return ""
            const img = !this.isAsset ? isStorageFile(this.img) : isAssetFile(this.img)
            return removeDoubleSlashFromUrl(img)
        }
    },
    methods: {
        replaceByDefault(e) {
            e.target.src = isAssetFile(this.$noImagePlaceholder)
        },
        isStorageFile: isStorageFile,
        isAssetFile: isAssetFile,
        isEmpty: isEmpty
    }
}
</script>
