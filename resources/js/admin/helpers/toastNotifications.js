export const toastNotifications = {
    methods: {
        errorToast(msg, postion = "is-top", duration = 2000) {
            this.$buefy.toast.open({
                message: msg,
                type: "is-danger",
                position: postion,
                duration: duration
            })
        },
        successToast(msg, postion = "is-top", duration = 2000) {
            this.$buefy.toast.open({
                message: msg,
                type: "is-success",
                position: postion,
                duration: duration
            })
        },
        warningToast(msg, postion = "is-top", duration = 2000) {
            this.$buefy.toast.open({
                message: msg,
                type: "is-warning",
                position: postion,
                duration: duration
            })
        },
        customSimpleToast(msg, postion = "is-top", type = "is-info", duration = 2000) {
            this.$buefy.toast.open({
                message: msg,
                type: type,
                position: postion,
                duration: duration
            })
        }
    }
}
