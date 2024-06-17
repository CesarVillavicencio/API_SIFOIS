<template>
    <section class="hero default_gradient_background is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="columns">
                    <div class="column is-4 is-offset-4 has-text-centered">
                        <div class="title is-1">404</div>

                        <div class="box">
                            <div class="title is-3 mb-4">¡UPS! ¡Página no encontrada!</div>
                            <div class="subtitle nt-4 mb-4">
                                No pudimos encontrar la página que estabas buscando. Mientras tanto, puede volver al
                                panel de control.
                            </div>
                            <div class="mt-4 buttons is-justify-content-center">
                                <b-button type="is-primary" @click="goBack"> Regresar </b-button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    methods: {
        goBack() {
            this.$router.push({ name: this.$namedRoutes.dashboard })
        }
    }
}
</script>
