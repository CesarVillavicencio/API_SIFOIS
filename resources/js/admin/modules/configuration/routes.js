import BaseModule from "@admin/components/basemodule.vue"
import Edit from "./edit.vue"

export default [
    {
        path: "/configuration",
        component: BaseModule,
        name: "Configuration",
        redirect: "/configuration/index",
        children: [
            {
                name: "Configuration Edit",
                path: "edit",
                component: Edit,
                meta: { requiresAuth: true }
            }
        ]
    }
]
