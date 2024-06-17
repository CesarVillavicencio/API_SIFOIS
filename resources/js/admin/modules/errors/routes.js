import BaseModule from "@admin/components/basemodule.vue"
import Results from "./results.vue"

export default [
    {
        path: "/errors",
        component: BaseModule,
        name: "Errors",
        redirect: "/errors/results",
        children: [
            {
                name: "System Errors",
                path: "results",
                component: Results,
                metas: { requireAuth: true }
            }
        ]
    }
]
