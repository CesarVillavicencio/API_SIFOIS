export const dialogNotifications = {
    methods: {
        errorDialog(message, title = "Error") {
            this.$buefy.dialog.alert({
                title: title,
                message: message,
                type: "is-danger",
                hasIcon: true,
                icon: "times-circle",
                ariaRole: "alertdialog",
                ariaModal: true
            })
        },
        successDialog(message, title = "Exito") {
            this.$buefy.dialog.alert({
                title: title,
                message: message,
                type: "is-success",
                hasIcon: true,
                icon: "check-circle",
                ariaRole: "alertdialog",
                ariaModal: true
            })
        },
        warningDialog(message, title = "Advertencia") {
            this.$buefy.dialog.alert({
                title: title,
                message: message,
                type: "is-warning",
                hasIcon: true,
                icon: "exclamation-circle",
                ariaRole: "alertdialog",
                ariaModal: true
            })
        },
        customDialog(message, title, type, hasIcon, icon) {
            this.$buefy.dialog.alert({
                title: title,
                message: message,
                type: type,
                hasIcon: hasIcon,
                icon: icon,
                ariaRole: "alertdialog",
                ariaModal: true
            })
        }
    }
}
