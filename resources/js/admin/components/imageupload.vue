<template>
    <div class="component_imageupload_zone is-relative">
        <b-loading :active="loading" :is-full-page="false" />

        <div v-if="hasfile" class="buttons is-justify-content-center">
            <b-button icon-left="times-circle" type="is-danger" @click="removeImageFile"> Remover </b-button>
        </div>

        <div v-if="hasfile" class="is-flex is-justify-content-center">
            <fitimage
                v-if="renderedImage != ''"
                :img="renderedImage"
                imgclasses="nice_shadow"
                ratio=""
                container-style="max-width: 350px;" />
        </div>

        <b-field v-if="!hasfile">
            <b-upload v-model="file" drag-drop expanded @input="newFileAdded">
                <section class="section">
                    <div class="content has-text-centered">
                        <p><b-icon icon="upload" size="is-large"></b-icon></p>
                        <p>Suelta tu archivo de imagen aquí o haz clic para subir el archivo</p>
                    </div>
                </section>
            </b-upload>
        </b-field>
    </div>
</template>

<script>
import { formatBytes } from "@admin/tools"

export default {
    props: {
        image: {
            type: String,
            default: ""
        },
        loading: {
            type: Boolean,
            default: false
        },
        hasfile: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            file: {},
            renderedImage: ""
        }
    },
    watch: {
        image(val) {
            this.renderedImage = val
        }
    },
    mounted() {
        this.renderedImage = this.image ? this.image : ""
    },
    methods: {
        newFileAdded(file) {
            // File Size Validation
            if (file.size > this.$maxFileSize) {
                this.$buefy.toast.open({
                    message: "Tu archivo es muy grande. El valor máximo es de " + formatBytes(this.$maxFileSize) + ".",
                    type: "is-danger"
                })
                return
            }

            // File Extension
            if (!/\.(jpg|jpeg|png|gif)$/i.test(file.name)) {
                this.$buefy.toast.open({
                    message: "Tu archivo no es una imagen válida. Formatos validos son jpg, jpeg, png, gif.",
                    type: "is-danger"
                })
                return
            }

            // Generate Image Url
            file.url = ""
            let URL = window.URL || window.webkitURL
            if (URL && URL.createObjectURL) {
                file.url = URL.createObjectURL(file)
                this.renderedImage = file.url
                this.uploadImageFile()
            }
        },
        removeImageFile() {
            this.file = {}
            this.renderedImage = ""
            this.$emit("remove")
        },
        uploadImageFile() {
            this.$emit("upload", this.file)
        }
    }
}
</script>
