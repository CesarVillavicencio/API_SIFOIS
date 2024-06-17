<template>
    <div class="photo_info is-relative">
        <div class="box">
            <b-field
                label="Título"
                :type="getErrorMsgTool(errors, 'title', { class: 'is-danger' })"
                :message="getErrorMsgTool(errors, 'title')">
                <b-input v-model="photo.title" size="is-small" type="text" placeholder="Título" />
            </b-field>

            <b-field
                :type="getErrorMsgTool(errors, 'id_category', { class: 'is-danger' })"
                :message="getErrorMsgTool(errors, 'id_category')">
                <div slot="label">
                    <span>Categoría </span>
                    <b-button type="is-ghost" size="is-small" icon-left="plus-square" @click="openAddCategoryModal">
                        Crear
                    </b-button>
                </div>

                <b-select v-model="photo.id_category" size="is-small" :loading="loading_categories" expanded>
                    <option v-for="category in categories" :key="category.id" :value="category.id">
                        {{ category.name }}
                    </option>
                </b-select>
            </b-field>
        </div>

        <div class="box pr-6">
            <b-field
                label="Descripción"
                :type="getErrorMsgTool(errors, 'description', { class: 'is-danger' })"
                :message="getErrorMsgTool(errors, 'description')">
                <b-input v-model="photo.description" maxlength="500" type="textarea"> </b-input>
            </b-field>
        </div>
    </div>
</template>

<script>
import { mapState, mapWritableState, mapActions } from "pinia"
import useGalleryStore from "./store"
import { getErrorMsgTool } from "@admin/tools"
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { toastNotifications } from "@admin/helpers/toastNotifications"

export default {
    mixins: [handleErrorMessages, toastNotifications],
    computed: {
        ...mapState(useGalleryStore, ["categories", "loading_categories", "errors"]),
        ...mapWritableState(useGalleryStore, ["photo"])
    },
    methods: {
        ...mapActions(useGalleryStore, ["addNewCategoryFromPhoto"]),
        openAddCategoryModal() {
            this.$buefy.dialog.prompt({
                message: "¿Cuál es el nuevo nombre de la categoría?",
                inputAttrs: { maxlength: 100 },
                trapFocus: true,
                onConfirm: (value) => {
                    this.addNewCategoryFromPhoto(value)
                        .then((category) => {
                            this.successToast("Categoría creada!")
                            this.photo.id_category = category.id
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
