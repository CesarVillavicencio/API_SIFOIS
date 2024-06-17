import Base from "./base.vue"
import Login from "./login.vue"

export default [
    {
        path: "/auth",
        component: Base,
        name: "Auth",
        redirect: "/auth/login",
        children: [
            {
                name: "Login",
                path: "login",
                component: Login
            }
        ]
    }
]
