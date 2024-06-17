import BaseModule from "@admin/components/basemodule.vue"
import Posts from "./posts.vue"
import Post from "./post.vue"
import Categories from "./categories.vue"

export default [
    {
        path: "/blog",
        component: BaseModule,
        name: "Blog",
        redirect: "/blog/posts",
        children: [
            {
                name: "Blog Posts List",
                path: "posts",
                component: Posts,
                meta: { requiresAuth: true }
            },
            {
                name: "Blog Create Post",
                path: "posts/create",
                component: Post,
                meta: { requiresAuth: true }
            },
            {
                name: "Blog Edit Post",
                path: "posts/edit/:id",
                component: Post,
                meta: { requiresAuth: true }
            },
            {
                name: "Blog Categories List",
                path: "categories",
                component: Categories,
                meta: { requiresAuth: true }
            }
        ]
    }
]
