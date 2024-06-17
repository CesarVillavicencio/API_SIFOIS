<template>
    <div class="users_list is-relative">
        <b-loading v-model="loading" :is-full-page="false" />

        <h2 class="title">
            <font-awesome-icon :icon="['fa', 'user']" />
            Usuarios
        </h2>

        <div class="columns">
            <div class="column is-one-quarter-desktop">
                <div class="buttons mb-0 mt-4">
                    <b-button type="is-primary" size="is-small" icon-left="plus-square" @click="goCreateUser">
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
                :data="users"
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
                    label="Avatar"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    width="100">
                    <div class="is-flex is-align-items-center">
                        <fitimage
                            ratio=""
                            imgclasses="nice_shadow"
                            :img="props.row.avatar"
                            style="width: 50px; height: auto" />
                    </div>
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Nombre completo"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="name">
                    {{ props.row.full_name }}
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Correo"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="email">
                    <b-tag>{{ props.row.email }}</b-tag>
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Tipo"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="type">
                    <b-tag :type="checkUserType(props.row.type)">{{ props.row.type }}</b-tag>
                </b-table-column>

                <b-table-column
                    v-slot="props"
                    label="Creado"
                    header-class="is-size-7"
                    cell-class="is-size-7"
                    sortable
                    field="created_at">
                    <div>{{ $dayjs(props.row.created_at).format("YYYY-MM-DD") }}</div>
                </b-table-column>

                <b-table-column v-slot="props">
                    <div class="buttons">
                        <b-tooltip :label="isBlocked(props.row.blocked_at)[1]">
                            <b-button
                                class="mr-2"
                                size="is-small"
                                :type="isBlocked(props.row.blocked_at)[2]"
                                :icon-left="isBlocked(props.row.blocked_at)[0]"
                                @click="toggleBlocked(props.row.id)">
                            </b-button>
                        </b-tooltip>
                        <b-tooltip label="Editar">
                            <b-button
                                class="mr-2"
                                size="is-small"
                                type="is-warning"
                                icon-left="edit"
                                @click="goEditUser(props.row.id)">
                            </b-button>
                        </b-tooltip>
                        <b-tooltip label="Borrar">
                            <b-button
                                size="is-small"
                                type="is-danger"
                                icon-left="trash-alt"
                                @click="deleteUserRecord(props.row.id)">
                            </b-button>
                        </b-tooltip>
                    </div>
                </b-table-column>

                <template #empty><div class="has-text-centered">...</div></template>
            </b-table>
        </div>
    </div>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useUserStore from "./store"
import tfilters from "@admin/components/tfilters.vue"
import { toastNotifications } from "@admin/helpers/toastNotifications"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"

export default {
    components: { tfilters },
    mixins: [toastNotifications, handleErrorMessages],
    computed: {
        ...mapState(useUserStore, ["users", "pagination", "loading"]),
        ...mapWritableState(useUserStore, ["filters"]),
        getFilterOptions() {
            return [
                { text: "Buscar por nombre", value: "name", type: "text" },
                { text: "Buscar por apellido", value: "lastname", type: "text" },
                { text: "Buscar por correo", value: "email", type: "text" },
                { text: "Buscar por tipo de usuario", value: "type", type: "text" },
                {
                    text: "Buscar por usuario bloqueado",
                    value: "blocked_at",
                    type: "bool",
                    options: this.getBlockedAtFilterOptions()
                },
                { text: "Buscar por fecha de creación", value: "created", type: "date" }
            ]
        }
    },
    mounted() {
        this.getUsers()
    },
    methods: {
        ...mapActions(useUserStore, ["getUsers", "deleteUser", "toggleBlock"]),
        onPageChange(page) {
            let url = this.pagination.path + "?page=" + page
            this.getUsers(url)
        },
        doFilteredSearch(params) {
            this.filters.search = params.search
            this.filters.selected = params.selected
            this.getUsers()
        },
        sortPressed(field, order) {
            this.filters.sort_field = field
            this.filters.order = order
            this.getUsers()
        },
        isBlocked(blocked_at) {
            return blocked_at ? ["lock", "Bloqueado", "is-danger"] : ["lock-open", "No Bloqueado", "is-info"]
        },
        toggleBlocked(id_user) {
            this.$buefy.dialog.confirm({
                title: "Cambiar el estado del usuario",
                message: "¿Está seguro de que desea <b> cambiarlo </b>?",
                confirmText: "Cambiar",
                cancelText: "Cancelar",
                type: "is-warning",
                hasIcon: true,
                onConfirm: () => {
                    this.toggleBlock(id_user)
                        .then(() => {
                            this.successToast("Usuario actualizado!")
                        })
                        .catch((error) => {
                            this.handleErrorMessage(error)
                        })
                }
            })
        },
        goCreateUser() {
            this.$router.push({ name: this.$namedRoutes.users.create })
        },
        goEditUser(id_user) {
            this.$router.push({
                name: this.$namedRoutes.users.edit,
                params: { id: id_user }
            })
        },
        deleteUserRecord(id_user) {
            this.$buefy.dialog.confirm({
                title: "Borrar Usuario",
                message: "¿Está seguro de que desea <b> eliminarlo </b>? Esta acción no se puede deshacer.",
                confirmText: "Borrar",
                cancelText: "Cancelar",
                type: "is-danger",
                hasIcon: true,
                onConfirm: () => {
                    this.deleteUser(id_user)
                        .then(() => {
                            this.successToast("Usuario actualizado!")
                        })
                        .catch((error) => {
                            this.handleErrorMessage(error)
                        })
                }
            })
        },
        getBlockedAtFilterOptions() {
            return [
                { text: "Bloqueado", value: 1 },
                { text: "No Bloqueado", value: 0 }
            ]
        },
        checkUserType(type) {
            switch (type) {
                case "suadmin":
                    return "is-success"
                case "admin":
                    return "is-info"
                case "editor":
                    return "is-warning"
                default:
                    return "is-grey"
            }
        }
    }
}
</script>
