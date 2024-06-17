export default [
    {
        name: "general",
        modules: [
            {
                name: "Dashboard",
                route_name: "Dashboard Index",
                routes_names: ["Dashboard Index"],
                icon: ["fa", "tachometer-alt"]
            }
        ]
    },
    {
        name: "Blog",
        modules: [
            {
                name: "Categorías",
                route_name: "Blog Categories List",
                routes_names: ["Blog Categories List"],
                icon: ["fa", "archive"]
            },
            {
                name: "Posts",
                route_name: "Blog Posts List",
                routes_names: ["Blog Posts List", "Blog Create Post", "Blog Edit Post"],
                icon: ["fa", "newspaper"]
            }
        ]
    },
    {
        name: "Galería",
        modules: [
            {
                name: "Categorías",
                route_name: "Gallery Categories List",
                routes_names: ["Gallery Categories List"],
                icon: ["fa", "archive"]
            },
            {
                name: "Fotos",
                route_name: "Gallery Photos List",
                routes_names: ["Gallery Photos List", "Gallery Create Photo", "Gallery Edit Photo"],
                icon: ["fa", "images"]
            }
        ]
    },
    {
        name: "Sistema",
        modules: [
            {
                name: "Usuarios",
                route_name: "Users List",
                routes_names: ["Users List", "Create User", "Edit User"],
                icon: ["fa", "users"]
            },
            {
                name: "Sys Errors",
                route_name: "System Errors",
                routes_names: ["System Errors"],
                icon: ["fa", "bomb"]
            },
            {
                name: "Configuración",
                route_name: "Configuration Edit",
                routes_names: ["Configuration Edit"],
                icon: ["fa", "cogs"]
            }
        ]
    }
]
