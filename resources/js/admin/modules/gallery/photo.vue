<template>
    <div class="gallery_photos_inputs is-relative">
        <b-loading v-model="loading" :is-full-page="false" />

        <h2 class="title">
            <font-awesome-icon :icon="['fa', 'images']" />
            {{ getTitle }}
        </h2>

        <div class="buttons mb-4">
            <b-button icon-left="arrow-left" size="is-small" @click="goBack"> Regresar </b-button>
            <b-button v-if="update_on" type="is-primary" size="is-small" icon-left="pen-square" @click="update">
                Actualizar
            </b-button>
            <b-button v-else type="is-primary" size="is-small" icon-left="plus-square" @click="create">
                Crear
            </b-button>
        </div>

        <errorlist :errors="errors" />

        <div class="columns">
            <div class="column">
                <infophoto />
            </div>
            <div class="column">
                <photoupload />
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useGalleryStore from "./store"
import infophoto from "./infophoto.vue"
import photoupload from "./photoupload.vue"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"
import errorlist from "@admin/components/errorlist.vue"

export default {
    components: { infophoto, photoupload, errorlist },
    mixins: [handleErrorMessages, toastNotifications],
    beforeRouteLeave(to, from, next) {
        this.cleanForm()
        next()
    },
    computed: {
        ...mapState(useGalleryStore, ["errors", "loading"]),
        ...mapWritableState(useGalleryStore, ["update_on"]),
        getTitle() {
            return this.update_on ? "Actualizar Foto" : "Agregar Foto"
        }
    },
    mounted() {
        this.getCategories()
        if (this.$route.name == this.$namedRoutes.gallery.edit) {
            this.update_on = true
            this.getPhoto(this.$route.params.id)
        }
    },
    methods: {
        ...mapActions(useGalleryStore, ["getPhoto", "getCategories", "createPhoto", "updatePhoto", "cleanForm"]),
        goBack() {
            this.$router.replace({ name: this.$namedRoutes.gallery.photos })
        },
        create() {
            this.createPhoto()
                .then(() => {
                    this.successToast("Foto agregada!")
                    this.update_on = false
                    this.$router.push({ name: this.$namedRoutes.gallery.photos })
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        },
        update() {
            this.updatePhoto()
                .then(() => {
                    this.successToast("Foto actualizada!")
                    this.update_on = false
                    this.$router.push({ name: this.$namedRoutes.gallery.photos })
                })
                .catch((error) => {
                    this.handleErrorMessage(error)
                })
        }
    }
}
</script>
