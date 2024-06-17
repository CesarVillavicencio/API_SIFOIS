import BaseModule from "@admin/components/basemodule.vue"
import Test from "./test.vue"

export default [
    {
        path: "/test",
        component: BaseModule,
        name: "Test",
        redirect: "/test/test",
        children: [
            {
                name: "Test Module",
                path: "test",
                component: Test,
                meta: { requiresAuth: true }
            }
        ]
    }
]
