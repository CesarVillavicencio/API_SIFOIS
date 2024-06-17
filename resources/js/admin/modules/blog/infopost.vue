<template>
    <div class="columns is-multiline">
        <div class="column is-6">
            <div class="box">
                <b-field
                    label="Título"
                    :type="getErrorMsgTool(errors, 'title', { class: 'is-danger' })"
                    :message="getErrorMsgTool(errors, 'title')">
                    <b-input v-model="post.title" size="is-small" type="text" placeholder="Título" />
                </b-field>

                <b-field label="Fecha">
                    <b-datepicker v-model="post.date" size="is-small" icon="calendar-alt" trap-focus />
                </b-field>

                <b-field label="Tags">
                    <b-taginput
                        v-model="post.tags"
                        size="is-small"
                        ellipsis
                        icon="caret-square-right"
                        placeholder="Agregar tag"
                        aria-close-label="Remover tag">
                    </b-taginput>
                </b-field>
            </div>
        </div>
        <div class="column is-6">
            <div class="box">
                <b-field
                    :type="getErrorMsgTool(errors, 'id_category', { class: 'is-danger' })"
                    :message="getErrorMsgTool(errors, 'id_category')">
                    <div slot="label">
                        <span>Categoría </span>
                        <b-button type="is-ghost" size="is-small" icon-left="plus-square" @click="openAddCategoryModal">
                            Crear
                        </b-button>
                    </div>

                    <b-select
                        v-model="post.id_category"
                        :loading="loading_categories"
                        placeholder="Categoría"
                        size="is-small"
                        expanded>
                        <option v-for="category in categories" :key="category.id" :value="category.id">
                            {{ category.name }}
                        </option>
                    </b-select>
                </b-field>

                <b-field
                    label="Autor"
                    :type="getErrorMsgTool(errors, 'author', { class: 'is-danger' })"
                    :message="getErrorMsgTool(errors, 'author')">
                    <b-input v-model="post.author" size="is-small" type="text" placeholder="Autor" />
                </b-field>

                <b-field
                    label="Publicado"
                    :type="getErrorMsgTool(errors, 'publish', { class: 'is-danger' })"
                    :message="getErrorMsgTool(errors, 'publish')">
                    <b-select v-model="post.publish" size="is-small" expanded>
                        <option v-for="(option, i) in getPublishOptions" :key="i" :value="option.value">
                            {{ option.text }}
                        </option>
                    </b-select>
                </b-field>
            </div>
        </div>
        <div class="column is-12">
            <div class="box pr-6">
                <b-field
                    label="Descripción"
                    :type="getErrorMsgTool(errors, 'description', { class: 'is-danger' })"
                    :message="getErrorMsgTool(errors, 'description')">
                    <b-input v-model="post.description" size="is-small" type="textarea" maxlength="500" expanded />
                </b-field>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useBlogStore from "./store"
import { getErrorMsgTool } from "@admin/tools"
import { toastNotifications } from "@admin/helpers/toastNotifications"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"

export default {
    mixins: [toastNotifications, handleErrorMessages],
    computed: {
        ...mapState(useBlogStore, ["categories", "loading_categories", "errors"]),
        ...mapWritableState(useBlogStore, ["post"]),
        getPublishOptions() {
            return [
                { text: "Publicado", value: true },
                { text: "No Publicado", value: false }
            ]
        }
    },
    methods: {
        ...mapActions(useBlogStore, ["addNewCategoryFromPost"]),
        openAddCategoryModal() {
            this.$buefy.dialog.prompt({
                message: "¿Cuál es el nuevo nombre de la categoría?",
                inputAttrs: { maxlength: 100 },
                trapFocus: true,
                onConfirm: (value) => {
                    this.addNewCategoryFromPost(value)
                        .then((category) => {
                            this.successToast("Categoría creada!")
                            this.post.id_category = category.id
                        })
                        .catch((error) => {
                            this.handleErrorMessage(error)
                        })
                }
            })
        },
        getErrorMsgTool: getErrorMsgTool
    }
}
</script>
