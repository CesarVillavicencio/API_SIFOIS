import { SnackbarProgrammatic as Snackbar } from "buefy"
import config from "@ce/config"

const openSnackbar = (
    message,
    type = "is-success",
    position = "is-bottom-right",
    duration = 5000,
    url = null,
    actionText = "Ok"
) => {
    Snackbar.open({
        type: type,
        message: message,
        position: position,
        duration: duration,
        actionText: actionText,
        onAction: () => {
            if (url) {
                window.open(config.publicUrl + url, "_blank")
            }
        }
    })
}

export default openSnackbar
