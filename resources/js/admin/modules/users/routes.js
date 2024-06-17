import BaseModule from "@admin/components/basemodule.vue"
import Users from "./users.vue"
import User from "./user.vue"

export default [
    {
        path: "/users",
        component: BaseModule,
        name: "Users",
        redirect: "/users/list",
        children: [
            {
                name: "Users List",
                path: "list",
                component: Users,
                meta: { requiresAuth: true }
            },
            {
                name: "Create User",
                path: "create",
                component: User,
                meta: { requiresAuth: true }
            },
            {
                name: "Edit User",
                path: "edit/:id",
                component: User,
                meta: { requiresAuth: true }
            }
        ]
    }
]
