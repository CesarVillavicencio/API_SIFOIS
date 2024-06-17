import { ToastProgrammatic as Toast } from "buefy"

const openToast = (message, type = "is-warning", position = "is-bottom-left", duration = 5000) => {
    Toast.open({
        type: type,
        message: message,
        position: position,
        duration: duration
    })
}

export default openToast
