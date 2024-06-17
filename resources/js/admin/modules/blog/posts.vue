<template>
    <div class="blog_posts is-relative">
        <b-loading v-model="loading" :is-full-page="false" />

        <h2 class="title">
            <font-awesome-icon :icon="['fa', 'newspaper']" />
            Posts del Blog
        </h2>

        <div class="columns">
            <div class="column is-one-quarter-desktop">
                <div class="buttons mb-0 mt-4">
                    <b-button type="is-primary" icon-left="plus-square" size="is-small" @click="goCreatePost">
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
                :data="posts"
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
                <b-table-column v-slot="props" label="Imagen" header-class="is-size-7" cell-class="is-size-7">
                    <div class="is-flex is-align-items-center clickeable" @click="showImg(props.index)">
                        <fitimage
                            ratio=""
                            imgclasses="nice_shadow"
                            :img="props.row.thumb"
                            style="width: 50px; height: auto" />
                    </div>
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Título"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="title">
                    <div
                        class="is-flex is-flex-direction-column is-align-items-start-desktop is-align-items-end-tablet">
                        <div class="has-text-weight-bold" style="max-width: 250px">{{ props.row.title }}</div>
                        <small v-if="props.row.admin_user" class="has-text-primary">{{
                            props.row.admin_user.full_name
                        }}</small>
                    </div>
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Fecha"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="date">
                    {{ $dayjs(props.row.date).format("YYYY-MM-DD") }}
                </b-table-column>

                <b-table-column v-slot="props" label="Categoría" header-class="is-size-7" cell-class="is-size-7">
                    <b-tag v-if="props.row.category">{{ props.row.category.name }}</b-tag>
                    <b-tag v-else>---</b-tag>
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Visitas"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="visits">
                    {{ props.row.visits }}
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Autor"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="author">
                    {{ props.row.author }}
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
                    <div class="buttons is-justify-content-space-evenly">
                        <b-tooltip :label="isPublished(props.row.publish)[1]">
                            <b-button
                                size="is-small"
                                :type="isPublished(props.row.publish)[2]"
                                :icon-left="isPublished(props.row.publish)[0]"
                                @click="togglePublishRecord(props.row.id)" />
                        </b-tooltip>
                        <b-tooltip label="Editar">
                            <b-button
                                size="is-small"
                                type="is-warning"
                                icon-left="edit"
                                @click="goEditPost(props.row.id)" />
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
import useBlogStore from "./store"
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
        ...mapState(useBlogStore, ["posts", "pagination", "loading"]),
        ...mapWritableState(useBlogStore, ["filters"]),
        getFilterOptions() {
            return [
                { text: "Buscar por título", value: "title", type: "text" },
                { text: "Buscar por fecha", value: "date", type: "date" },
                { text: "Buscar por autor", value: "author", type: "text" },
                { text: "Buscar por visitas mayor a", value: "visits_max", type: "number" },
                { text: "Buscar por visitas menor a", value: "visits_min", type: "number" },
                { text: "Buscar por estado", value: "publish", type: "bool", options: this.getPublishFilterOptions() },
                { text: "Buscar por usuario creador", value: "admin_user", type: "text" },
                { text: "Buscar por categoría", value: "category", type: "text" },
                { text: "Buscar por fecha de creación", value: "created", type: "date" }
            ]
        },
        getLightBoxImages() {
            let lightboxdata = []
            this.posts.forEach((post) => {
                lightboxdata.push(isStorageFile(post.image))
            })
            return lightboxdata
        }
    },
    mounted() {
        this.getPosts()
    },
    methods: {
        ...mapActions(useBlogStore, ["getPosts", "deletePost", "togglePublish"]),
        onPageChange(page) {
            const url = this.pagination.path + "?page=" + page
            this.getPosts(url)
        },
        doFilteredSearch(params) {
            this.filters.search = params.search
            this.filters.selected = params.selected
            this.getPosts()
        },
        sortPressed(field, order) {
            this.filters.sort_field = field
            this.filters.order = order
            this.getPosts()
        },
        isPublished(publish) {
            return publish ? ["eye", "Publicado", "is-info"] : ["eye-slash", "No Publicado", "is-danger"]
        },
        togglePublishRecord(id_post) {
            this.$buefy.dialog.confirm({
                title: "Cambiar estado del Post",
                message: "¿Está seguro de que desea <b> cambiarlo </b>?",
                confirmText: "Cambiar",
                cancelText: "Cancelar",
                type: "is-warning",
                hasIcon: true,
                onConfirm: () => {
                    this.togglePublish(id_post)
                        .then(() => {
                            this.successToast("Post actualizado!")
                        })
                        .catch((error) => {
                            this.handleErrorMessage(error)
                        })
                }
            })
        },
        goCreatePost() {
            this.$router.push({ name: this.$namedRoutes.blog.create })
        },
        goEditPost(id_post) {
            this.$router.push({
                name: this.$namedRoutes.blog.edit,
                params: { id: id_post }
            })
        },
        deletePostRecord(id_post) {
            this.$buefy.dialog.confirm({
                title: "Borrar Post",
                message: "¿Está seguro de que desea <b> eliminarlo </b>? Esta acción no se puede deshacer.",
                confirmText: "Borrar",
                cancelText: "Cancelar",
                type: "is-danger",
                hasIcon: true,
                onConfirm: () => {
                    this.deletePost(id_post)
                        .then(() => {
                            this.successToast("Post borrado!")
                        })
                        .catch((error) => {
                            this.handleErrorMessage(error)
                        })
                }
            })
        },
        getPublishFilterOptions() {
            return [
                { text: "Publicado", value: 1 },
                { text: "No Publicado", value: 0 }
            ]
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
