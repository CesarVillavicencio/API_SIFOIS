<template>
    <div class="gallery_photos is-relative">
        <b-loading v-model="loading" :is-full-page="false" />

        <h2 class="title">
            <font-awesome-icon :icon="['fa', 'images']" />
            Fotos de la Galería
        </h2>

        <div class="columns">
            <div class="column is-one-quarter-desktop">
                <div class="buttons mb-0 mt-4">
                    <b-button type="is-primary" icon-left="plus-square" size="is-small" @click="goCreatePhoto">
                        Crear
                    </b-button>
                </div>
            </div>
            <div class="column">
                <tfilters :options="getFilterOptions" :store-selected="filters.selected" @search="doFilteredSearch" />
            </div>
        </div>

        <div class="box">
            <b-table
                :data="photos"
                :hoverable="true"
                :mobile-cards="true"
                paginated
                backend-pagination
                :total="pagination.total"
                :per-page="pagination.per_page"
                :backend-sorting="true"
                pagination-size="is-small"
                @sort="sortPressed"
                @page-change="onPageChange">
                <b-table-column
                    v-slot="props"
                    label="Imagen"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    width="100">
                    <div class="is-flex is-align-items-center clickeable" @click="showImg(props.index)">
                        <fitimage
                            ratio=""
                            imgclasses="nice_shadow"
                            :img="props.row.thumb"
                            style="width: 100px; height: auto" />
                    </div>
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Título"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="title">
                    <div style="max-width: 250px">{{ props.row.title }}</div>
                    <small v-if="props.row.admin_user" class="has-text-primary">{{
                        props.row.admin_user.full_name
                    }}</small>
                </b-table-column>

                <b-table-column v-slot="props" label="Categoría" header-class="is-size-7" cell-class="is-size-7">
                    <b-tag v-if="props.row.category">{{ props.row.category.name }}</b-tag>
                    <b-tag v-else>---</b-tag>
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Creado"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="created_at">
                    {{ $dayjs(props.row.created_at).format("YYYY-MM-DD") }}
                </b-table-column>

                <b-table-column v-slot="props">
                    <div class="buttons">
                        <b-tooltip label="Editar">
                            <b-button
                                class="mr-2"
                                size="is-small"
                                type="is-warning"
                                icon-left="edit"
                                @click="goEditPhoto(props.row.id)" />
                        </b-tooltip>
                        <b-tooltip label="Borrar">
                            <b-button
                                size="is-small"
                                type="is-danger"
                                icon-left="trash-alt"
                                @click="deletePostRecord(props.row.id)" />
                        </b-tooltip>
                    </div>
                </b-table-column>

                <template #empty><div class="has-text-centered">...</div></template>
            </b-table>
        </div>

        <lightbox :visible="visible" :imgs="getLightBoxImages" :index="indexImage" @hide="handleHide" />
    </div>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useGalleryStore from "./store"
import tfilters from "@admin/components/tfilters.vue"
import { toastNotifications } from "@admin/helpers/toastNotifications"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { isStorageFile } from "@admin/tools"
import lightbox from "vue-easy-lightbox"

export default {
    components: { tfilters, lightbox },
    mixins: [toastNotifications, handleErrorMessages],
    data() {
        return {
            visible: false,
            indexImage: 0
        }
    },
    computed: {
        ...mapState(useGalleryStore, ["photos", "pagination", "loading"]),
        ...mapWritableState(useGalleryStore, ["filters"]),
        getFilterOptions() {
            return [
                { text: "Buscar por título", value: "title", type: "text" },
                { text: "Buscar por usuario creador", value: "admin_user", type: "text" },
                { text: "Buscar por categoría", value: "category", type: "text" },
                { text: "Buscar por fecha de creación", value: "created", type: "date" }
            ]
        },
        getLightBoxImages() {
            let lightboxdata = []
            this.photos.forEach((photo) => {
                lightboxdata.push(isStorageFile(photo.image))
            })
            return lightboxdata
        }
    },
    mounted() {
        this.getPhotos()
    },
    methods: {
        ...mapActions(useGalleryStore, ["getPhotos", "deletePhoto"]),
        onPageChange(page) {
            let url = this.pagination.path + "?page=" + page
            this.getPhotos(url)
        },
        doFilteredSearch(params) {
            this.filters.search = params.search
            this.filters.selected = params.selected
            this.getPhotos()
        },
        sortPressed(field, order) {
            this.filters.sort_field = field
            this.filters.order = order
            this.getPhotos()
        },
        goCreatePhoto() {
            this.$router.push({ name: this.$namedRoutes.gallery.create })
        },
        goEditPhoto(id_photo) {
            this.$router.push({
                name: this.$namedRoutes.gallery.edit,
                params: { id: id_photo }
            })
        },
        deletePostRecord(id_photo) {
            this.$buefy.dialog.confirm({
                title: "Borrar Foto",
                message: "¿Está seguro de que desea <b> eliminarlo </b>? Esta acción no se puede deshacer.",
                confirmText: "Borrar",
                cancelText: "Cancelar",
                type: "is-danger",
                hasIcon: true,
                onConfirm: () => {
                    this.deletePhoto(id_photo)
                        .then(() => {
                            this.successToast("Foto borrada!")
                        })
                        .catch((error) => {
                            this.handleErrorMessage(error)
                        })
                }
            })
        },
        showImg(index) {
            this.indexImage = index
            this.visible = true
        },
        handleHide() {
            this.visible = false
        }
    }
}
</script>
