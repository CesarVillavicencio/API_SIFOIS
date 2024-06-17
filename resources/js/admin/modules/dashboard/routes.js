import BaseModule from "@admin/components/basemodule.vue"
import Index from "./index.vue"

export default [
    {
        path: "/dashboard",
        component: BaseModule,
        name: "Dashboard",
        redirect: "/dashboard/index",
        children: [
            {
                name: "Dashboard Index",
                path: "index",
                component: Index,
                meta: { requiresAuth: true }
            }
        ]
    }
]
