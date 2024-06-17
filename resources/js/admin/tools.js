import config from "./config"
import dayjs from "./dayjs"
import { ToastProgrammatic as Toast } from "buefy"

export function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

export function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1)
}

export function setZoneScrollToBottom(id_element) {
    var container = document.querySelector(id_element)
    container.scrollTop = container.scrollHeight
}

export function setScrollToElement(id_element, offset = 0) {
    var element = document.querySelector(id_element)
    const y = element.getBoundingClientRect().top + window.scrollY - offset
    window.scroll({ top: y, behavior: "smooth" })
}

export function isValidFileSize(file, maxsize) {
    if (file.size > maxsize) {
        return false
    }
    return true
}

export function isValidImageExtension(file) {
    if (!/\.(jpg|jpeg|png|gif)$/i.test(file.name)) {
        return false
    } else {
        return true
    }
}

export function paginate(array, page_size, page_number) {
    return array.slice((page_number - 1) * page_size, page_number * page_size)
}

export function randomString(length = 8) {
    return Math.random()
        .toString(16)
        .substring(2, 2 + length)
}

export function inputError(errors, field, classname) {
    if (errors) {
        if (errors[field]) {
            return classname
        }
    }
    return ""
}

export function inputErrorMsg(errors, field) {
    if (errors) {
        if (errors[field]) {
            return errors[field][0]
        }
    }
    return ""
}

export function hasErrorField(errors, field) {
    if (errors) {
        if (errors[field]) {
            return true
        }
    }
    return false
}

export function getDateMinusDay(day_minus) {
    let d = new Date()
    return d.setDate(d.getDate() - day_minus)
}

/**
 * Creates a debounced version of a function that delays its execution until after a specified timeout.
 *
 * @param {function} func - The function to debounce.
 * @param {number} [timeout=300] - The timeout in milliseconds.
 * @return {function} - The debounced function.
 */
export function debounce(func, timeout = 300) {
    let timer
    return (...args) => {
        clearTimeout(timer)
        timer = setTimeout(() => {
            func.apply(this, args)
        }, timeout)
    }
}

export function uuid() {
    let dt = new Date().getTime()
    let uuid = "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (c) {
        let r = (dt + Math.random() * 16) % 16 | 0
        dt = Math.floor(dt / 16)
        return (c == "x" ? r : (r & 0x3) | 0x8).toString(16)
    })
    return uuid
}

export function isEmpty(data) {
    if (data == null || data == "") return true
    else return false
}

/**
 * Returns currency string format from number or string with numbers
 * @param {string|number} value
 * @returns {string}
 */
export function formatCurrency(value) {
    let val = parseFloat(value)
    return "$" + val.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,")
}

/**
 * Truncate Text Function
 * @param {string} str
 * @param {number} [length=100]
 * @param {string} [ending='...']
 * @returns {string}
 */
export function textTruncate(str, length = 100, ending = "...") {
    return str.length > length ? str.substring(0, length - ending.length) + ending : str
}

/**
 * Check if Image is an URL or File From Storage
 * @param {string} path
 * @param {boolean} [isBlob=false] optional
 * @returns {string}
 */
export function isStorageFile(path, isBlob = false) {
    if (!path) return config.noImagePlaceholder
    if (isBlob) return path

    if (path.startsWith("storage")) return config.publicUrl + path

    if (!/^(f|ht)tps?:\/\//i.test(path)) return config.publicUrl + "storage/" + path

    return path
}

/**
 * Check if Image is from static assets or storage
 * @param {string} path
 * @param {boolean} [isInStorage=false] optional
 * @returns {string}
 */
export function isAssetFile(path, isInStorage = false) {
    if (!path) return config.noImagePlaceholder
    if (!isInStorage) return config.publicUrl + path
    return config.publicUrl + "storage/" + path
}

/**
 * Get Readeable String from Bytes Number
 * @param {number} bytes
 * @param {number} decimals
 * @return {string}
 */
export function formatBytes(bytes, decimals) {
    if (bytes == 0) return "0 Bytes"
    var k = 1000,
        dm = decimals + 1 || 3,
        sizes = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"],
        i = Math.floor(Math.log(bytes) / Math.log(k))
    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + " " + sizes[i]
}

/**
 * Convert date from String Format to Date Format
 * @param {string} str_date
 * @returns {Date}
 */
export function convertStringToDate(str_date) {
    if (str_date == "") return null
    return new Date(str_date.replace(/-/g, "/"))
}

/**
 * Convert date from Date Format to Stirng Format
 * @param {Date} [date=new Date()]
 * @returns {string}
 */
export function convertDateToString(date = new Date()) {
    if (date == null) {
        return ""
    }
    return dayjs(date).format("YYYY-MM-DD")
    //return date.toLocaleString().substring(10, 0).replace(/\//g, '-')
}

/**
 * Generate Slug string from string value
 * @param {string} value
 * @returns {string}
 */
export function slugify(value) {
    value = value.replace(/^\s+|\s+$/g, "")
    value = value.toLowerCase()
    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;"
    var to = "aaaaaeeeeeiiiiooooouuuunc------"
    for (var i = 0, l = from.length; i < l; i++) {
        value = value.replace(new RegExp(from.charAt(i), "g"), to.charAt(i))
    }
    value = value
        .replace(/[^a-z0-9 -]/g, "")
        .replace(/\s+/g, "-")
        .replace(/-+/g, "-")
    return value
}

/**
 * Get Input Error Message
 * @param {Array|Object.<string, Array>} errors
 * @param {string} field
 * @param {Object.<string, any>=} returnOptions { bool: false, class: 'error' }
 * @return {boolean|string}
 */
export function getErrorMsgTool(errors, field, returnOptions) {
    const hasIt = errors && errors[field]

    if (returnOptions) {
        if (returnOptions.bool) return hasIt ? true : false
        if (returnOptions.class != null) return hasIt ? returnOptions.class : ""
    }

    return hasIt ? errors[field][0] : ""
}

/**
 * Input only accepts numbers
 * @param {any} evt
 * @return {boolean|any}
 */
export function onlyNumbersInputEvent(evt) {
    evt = evt ? evt : window.event
    var charCode = evt.which ? evt.which : evt.keyCode

    if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode !== 46) {
        evt.preventDefault()
    }

    return true
}

/**
 * Quitar "//" de la url string otorgada
 * @param {string} url
 * @return {string}
 */
export function removeDoubleSlashFromUrl(url) {
    if (url == null) {
        return ""
    }
    return url.replace(/([^:]\/)\/+/g, "$1")
}

/**
 * Set Glowing Animation on Element by ID
 * @param {string} element_id
 * @param {number} time
 * @return {void}
 */
export function setGlowingOnElement(element_id, time = 3000, className = "glowing") {
    document.getElementById(element_id).classList.add(className)
    setTimeout(() => {
        document.getElementById(element_id).classList.remove(className)
    }, time)
}

/**
 * Set Glowing Animation on Element by Class
 * @param {string} element_class
 * @param {number} time
 * @return {void}
 */
export function setGlowingOnElementByClass(element_class, time = 3000, isrelative = false) {
    document.getElementsByClassName(element_class)[0].classList.add("glowing")
    if (isrelative) {
        document.getElementsByClassName(element_class)[0].classList.add("is-relative")
    }
    setTimeout(() => {
        try {
            document.getElementsByClassName(element_class)[0].classList.remove("glowing")
            if (isrelative) {
                document.getElementsByClassName(element_class)[0].classList.remove("is-relative")
            }
        } catch (error) {
            // console.error(error)
        }
    }, time)
}

/**
 * Generate HTML table from array values
 * @param {array} elements
 * @param {string} classes
 * @param {array} ignoreHeaders
 * @return {string}
 */
export function getHtmlTableFromArray(elements, classes = "", ignoreHeaders = []) {
    let rows = "",
        headers = false
    for (let i = 0; i < elements.length; i++) {
        const keys = Object.keys(elements[i])

        // Generate Headers
        if (!headers) {
            rows += "<thead><tr>"
            for (let j = 0; j < keys.length; j++) {
                const key = keys[j]
                if (!ignoreHeaders.includes(key)) {
                    rows += '<th style="text-transform: capitalize;">' + key + "</th>"
                }
            }
            rows += "</tr></thead>"
            headers = true
        }

        // Generate Rows
        rows += "<tr>"
        for (let j = 0; j < keys.length; j++) {
            const key = keys[j]
            if (!ignoreHeaders.includes(key)) {
                rows += "<td>" + elements[i][key] + "</td>"
            }
        }
        rows += "</tr>"
    }

    return "<table class=" + classes + ">" + rows + "</table>"
}

/**
 * Copy to Clipboard a Text
 * @param {string} textToCopy
 * @return {void}
 */
export async function copyToClipboard(textToCopy, msg = null) {
    try {
        await navigator.clipboard.writeText(textToCopy)
        Toast.open({
            message: msg ? msg : "Texto Copiado!",
            type: "is-success",
            position: "is-top"
        })
    } catch (err) {
        Toast.open({
            message: "Falló al Copiar!",
            type: "is-danger",
            position: "is-top"
        })
        console.error("Failed to copy: ", err)
    }
}

/**
 * Get readeable number from string or number
 * @param {string|number} value
 * @return {string}
 */
export function readNum(value) {
    return Number(value).toLocaleString()
}

/**
 * Rounds the input number to two decimal places.
 *
 * @param {number} num - The number to be rounded.
 * @return {string} The rounded number as a string with two decimal places.
 */
export function setTwoDecimalsOnNumber(num) {
    return (Math.round(num * 100) / 100).toFixed(2)
}
