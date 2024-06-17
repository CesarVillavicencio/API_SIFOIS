<template>
    <b-dropdown v-if="activeItem" v-model="activeItem" aria-role="list" @change="changedItem">
        <template #trigger>
            <div class="is-flex is-align-items-center maxheight">
                <button class="button is-small" @click="activeItem.action">
                    <span class="icon is-small">
                        <img :src="isAssetFile(`images/tiptap/icons/${activeItem.icon}.svg`)" height="32" width="32" />
                    </span>
                    <span>{{ activeItem.title }}</span>
                    <span class="icon is-small">
                        <font-awesome-icon :icon="['fa', 'chevron-down']" />
                    </span>
                </button>
            </div>
        </template>

        <b-dropdown-item v-for="(item, index) in items" :key="index" aria-role="listitem" :value="item">
            <div class="media">
                <span class="media-left icon is-small">
                    <img :src="isAssetFile(`images/tiptap/icons/${item.icon}.svg`)" height="32" width="32" />
                </span>
                <div class="media-content">
                    <h3>{{ item.title }}</h3>
                </div>
            </div>
        </b-dropdown-item>
    </b-dropdown>
</template>

<script>
import { isAssetFile } from "@admin/tools"

export default {
    props: {
        items: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            currentItem: null
        }
    },
    computed: {
        activeItem: {
            get() {
                let index = this.items.findIndex((item) => item.isActive())
                return this.items[index]
            },
            set(value) {
                this.currentItem = value
            }
        }
    },
    mounted() {
        this.currentItem = this.items[0]
    },
    methods: {
        changedItem(item) {
            item.action()
        },
        isAssetFile: isAssetFile
    }
}
</script>

<style scoped>
a.dropdown-item.is-active,
button.dropdown-item.is-active {
    background-color: hsl(0, 0%, 96.1%);
    color: #000;
}
</style>
