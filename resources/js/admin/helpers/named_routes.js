export default {
    named_routes: {
        no_layout_routes: ["Login", "Forgot Password", "Reset Password", "Not Found"],
        auth: {
            login: "Login",
            forgot: "Forgot Password",
            reset: "Reset Password"
        },
        home: "Home",
        dashboard: "Dashboard Index",
        blog: {
            posts: "Blog Posts List",
            create: "Blog Create Post",
            edit: "Blog Edit Post",
            categories: "Blog Categories List"
        },
        gallery: {
            photos: "Gallery Photos List",
            create: "Gallery Create Photo",
            edit: "Gallery Edit Photo",
            categories: "Gallery Categories List"
        },
        users: {
            list: "Users List",
            create: "Create User",
            edit: "Edit User"
        },
        errors: "System Errors",
        notfound: "Not Found"
    }
}
