<template>
    <div class="gallery_categories is-relative">
        <b-loading v-model="loading" :is-full-page="false" />

        <h2 class="title">
            <font-awesome-icon :icon="['fa', 'archive']" />
            Categorías de la Galería
        </h2>

        <div class="columns">
            <div class="column is-one-quarter-desktop">
                <div class="buttons mb-0">
                    <b-button
                        type="is-primary"
                        size="is-small"
                        icon-left="plus-square"
                        @click="openCreateCategoryDialog">
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
                :data="categories"
                :hoverable="true"
                :mobile-cards="true"
                paginated
                backend-pagination
                :total="pagination.total"
                :per-page="pagination.per_page"
                pagination-size="is-small"
                @page-change="onPageChange">
                <b-table-column v-slot="props" label="Nombre" header-class="is-size-7" cell-class="is-size-7">
                    {{ props.row.name }}
                </b-table-column>

                <b-table-column v-slot="props" label="Número de Fotos" header-class="is-size-7" cell-class="is-size-7">
                    {{ props.row.count_photos }}
                </b-table-column>

                <b-table-column v-slot="props" label="Creado" header-class="is-size-7" cell-class="is-size-7">
                    {{ $dayjs(props.row.created_at).format("YYYY-MM-DD") }}
                </b-table-column>

                <b-table-column v-slot="props">
                    <div class="buttons">
                        <b-button
                            size="is-small"
                            type="is-warning"
                            icon-left="edit"
                            @click="openEditCategoryDialog(props.row.id, props.row.name)">
                            Editar
                        </b-button>
                        <b-button
                            size="is-small"
                            type="is-danger"
                            icon-left="trash-alt"
                            @click="deleteCategoryRecord(props.row.id)">
                            Borrar
                        </b-button>
                    </div>
                </b-table-column>

                <template #empty><div class="has-text-centered">...</div></template>
            </b-table>
        </div>
    </div>
</template>

<script>
import tfilters from "@admin/components/tfilters.vue"
import { toastNotifications } from "@admin/helpers/toastNotifications"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"

export default {
    components: { tfilters },
    mixins: [toastNotifications, handleErrorMessages],
    data() {
        return {
            filters: { search: "", selected: "name" },
            categories: [],
            pagination: { total: 0, per_page: 20 },
            loading: false
        }
    },
    computed: {
        getFilterOptions() {
            return [{ text: "Buscar por nombre", value: "name", type: "text" }]
        }
    },
    mounted() {
        this.getCategories()
    },
    methods: {
        getCategories(url = null) {
            this.loading = true
            let route = !url ? "/gallery/categories/get" : url
            window.axios
                .get(route, {
                    params: this.filters
                })
                .then((res) => {
                    this.categories = res.data.data
                    this.pagination = res.data
                    delete this.pagination.data
                    this.loading = false
                })
                .catch((error) => {
                    this.loading = false
                    console.log(error)
                })
        },
        onPageChange(page) {
            let url = this.pagination.path + "?page=" + page
            this.getCategories(url)
        },
        doFilteredSearch(params) {
            this.filters = params
            this.getCategories()
        },
        openCreateCategoryDialog() {
            this.$buefy.dialog.prompt({
                message: "Crear Categoría",
                inputAttrs: { value: "", maxlength: 191 },
                trapFocus: true,
                onConfirm: (value) => {
                    if (value == "") return null
                    this.createCategory({ name: value })
                }
            })
        },
        createCategory(data) {
            this.loading = true
            window.axios
                .post("/gallery/categories/create", data)
                .then(() => {
                    this.successToast("Categoría Creada!")
                    this.getCategories()
                    this.loading = false
                })
                .catch((error) => {
                    this.loading = false
                    this.handleErrorMessage(error)
                    console.log(error)
                })
        },
        openEditCategoryDialog(id_category, category_name) {
            const category = { id: id_category, name: category_name }
            this.$buefy.dialog.prompt({
                message: "Actualizar Categoría",
                inputAttrs: {
                    value: category.name,
                    maxlength: 191
                },
                trapFocus: true,
                onConfirm: (value) => {
                    if (value == "") return null
                    this.updateCategory({
                        id_category: category.id,
                        name: value
                    })
                }
            })
        },
        updateCategory(data) {
            this.loading = true
            window.axios
                .post("/gallery/categories/update", data)
                .then(() => {
                    this.successToast("Categoría Actualizada!")
                    this.getCategories()
                    this.loading = false
                })
                .catch((error) => {
                    this.loading = false
                    this.handleErrorMessage(error)
                    console.log(error)
                })
        },
        deleteCategoryRecord(id_category) {
            this.$buefy.dialog.confirm({
                title: "Borrar Categoría",
                message: "¿Estás seguro de borrar esta categoría?",
                confirmText: "Borrar",
                cancelText: "Cancelar",
                type: "is-danger",
                hasIcon: true,
                onConfirm: () => {
                    this.deleteCategory(id_category)
                }
            })
        },
        deleteCategory(id_category) {
            this.loading = true
            window.axios
                .post("/gallery/categories/delete", {
                    id: id_category
                })
                .then(() => {
                    this.loading = false
                    this.successToast("Categoría Borrada!")
                    this.getCategories()
                })
                .catch((error) => {
                    this.loading = false
                    this.handleErrorMessage(error)
                    console.log(error)
                })
        }
    }
}
</script>
