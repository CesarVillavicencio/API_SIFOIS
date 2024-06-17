<template>
    <div class="system_errors_zone is-relative">
        <b-loading v-model="loading" :is-full-page="false" />

        <h2 class="title">
            <font-awesome-icon :icon="['fa', 'bug']" />
            Errores del Sistema
        </h2>

        <div class="buttons">
            <b-button type="is-primary" icon-left="bug" size="is-small" @click="goLogViewer">
                Ir al Log-Viewer
            </b-button>
        </div>

        <!--
        "context" => "local"
        "level" => "error"
        "level_class" => "danger"
        "level_img" => "exclamation-triangle"
        "date" => "2018-05-10 10:08:29"
        "text" => "ErrorException: Accessing static property App\Http\Controllers\TestsController::$log_levels as non static"
        "in_file" => " in /var/www/komvac_template/app/Http/Controllers/TestsController.php:104"
        -->

        <div class="box">
            <b-table :data="errors" :hoverable="true" :mobile-cards="true">
                <b-table-column v-slot="props" label="Level">
                    <div :class="'has-text-' + props.row.level_class" class="has-text-centered">
                        <font-awesome-icon :icon="['fa', 'exclamation-triangle']" /> &nbsp; {{ props.row.level }}
                    </div>
                </b-table-column>

                <b-table-column v-slot="props" label="Context">
                    <b-tag>{{ props.row.context }}</b-tag>
                </b-table-column>

                <b-table-column v-slot="props" label="Date">
                    <div>{{ $dayjs(props.row.date).format("YYYY-MM-DD HH:mm:ss") }}</div>
                </b-table-column>

                <b-table-column v-slot="props" label="Content">
                    <div>{{ textTruncate(props.row.text, 300) }}</div>
                    <div style="color: darkmagenta">{{ props.row.in_file }}</div>
                    <div style="color: brown">{{ props.row.archivo }}</div>
                </b-table-column>

                <b-table-column v-slot="props">
                    <div class="buttons">
                        <b-button size="is-small" type="is-danger" icon-left="eye" @click="openDialogInfo(props.index)">
                        </b-button>
                    </div>
                </b-table-column>

                <template #empty><div class="has-text-centered">...</div></template>
            </b-table>
        </div>
    </div>
</template>

<script>
import { handleErrorMessages } from "@admin/helpers/handleErrorMessages"
import { textTruncate } from "@admin/tools"

export default {
    mixins: [handleErrorMessages],
    data() {
        return {
            loading: false,
            errors: []
        }
    },
    mounted() {
        this.getErrors()
    },
    methods: {
        getErrors() {
            this.loading = true
            window.axios
                .get("/log/errors/")
                .then((response) => {
                    this.errors = response.data
                    this.loading = false
                })
                .catch((error) => {
                    console.log(error)
                    this.loading = false
                    this.handleErrorMessage(error)
                })
        },
        openDialogInfo(index) {
            this.$buefy.dialog.alert({
                title: "System Error",
                message: this.errors[index].text,
                confirmText: "Ok"
            })
        },
        goLogViewer() {
            window.open("/log-viewer", "_blank")
        },
        textTruncate: textTruncate
    }
}
</script>
