<template>
    <div class="blog_posts_inputs is-relative">
        <b-loading v-model="loading" :is-full-page="false" />

        <h2 class="title">
            <font-awesome-icon :icon="['fa', 'newspaper']" />
            {{ getTitle }}
        </h2>

        <div class="buttons mb-4">
            <b-button size="is-small" icon-left="arrow-left" @click="goBack"> Regresar </b-button>
            <b-button v-if="update_on" size="is-small" type="is-primary" icon-left="pen-square" @click="update">
                Actualizar
            </b-button>
            <b-button v-else size="is-small" type="is-primary" icon-left="plus-square" @click="create">
                Crear
            </b-button>
        </div>

        <errorlist :errors="errors" />

        <b-tabs v-model="activeTab" type="is-toggle-rounded" size="is-small">
            <b-tab-item label="Información" icon="info-circle">
                <infopost />
            </b-tab-item>
            <b-tab-item label="Contenido" icon="file">
                <contentpost />
            </b-tab-item>
            <b-tab-item label="Imagen" icon="image">
                <imagepost />
            </b-tab-item>
        </b-tabs>
    </div>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useBlogStore from "./store"
import infopost from "./infopost.vue"
import contentpost from "./contentpost.vue"
import imagepost from "./imagepost.vue"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"
import errorlist from "@admin/components/errorlist.vue"

export default {
    components: { infopost, contentpost, imagepost, errorlist },
    mixins: [handleErrorMessages, toastNotifications],
    beforeRouteLeave(to, from, next) {
        this.cleanForm()
        next()
    },
    data() {
        return {
            activeTab: 0
        }
    },
    computed: {
        ...mapState(useBlogStore, ["errors", "loading"]),
        ...mapWritableState(useBlogStore, ["update_on"]),
        getTitle() {
            return this.update_on ? "Actualizar Post" : "Crear Post"
        }
    },
    async mounted() {
        await this.getCategories()
        if (this.$route.name == this.$namedRoutes.blog.edit) {
            this.update_on = true
            this.getPost(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions(useBlogStore, ["getPost", "getCategories", "createPost", "updatePost", "cleanForm"]),
        goBack() {
            this.$router.replace({ name: this.$namedRoutes.blog.posts })
        },
        create() {
            this.createPost()
                .then(() => {
                    this.successToast("Post creado!")
                    this.update_on = false
                    this.$router.push({ name: this.$namedRoutes.blog.posts })
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        },
        update() {
            this.updatePost()
                .then(() => {
                    this.successToast("Post actualizado!")
                    this.update_on = false
                    this.$router.push({ name: this.$namedRoutes.blog.posts })
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        }
    }
}
</script>
