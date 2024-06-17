export const handleErrorMessages = {
    methods: {
        handleErrorMessage(error) {
            if (error.response.data.message) {
                this.$buefy.toast.open({
                    message: error.response.data.message,
                    type: "is-danger"
                })
            } else {
                this.$buefy.toast.open({
                    message: "Server Error...",
                    type: "is-danger"
                })
            }
        }
    }
}
