// Global Dayjs + Dayjs Locales
import dayjs from "dayjs"

// Languages
import "dayjs/locale/es"
dayjs.locale("es")

// Plugins
import customParseFormat from "dayjs/plugin/customParseFormat"
dayjs.extend(customParseFormat)

import localizedFormat from "dayjs/plugin/localizedFormat"
dayjs.extend(localizedFormat)

export default dayjs
