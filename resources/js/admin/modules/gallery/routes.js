import BaseModule from "@admin/components/basemodule.vue"
import Photos from "./photos.vue"
import Photo from "./photo.vue"
import Categories from "./categories.vue"

export default [
    {
        path: "/gallery",
        component: BaseModule,
        name: "Gallery",
        redirect: "/gallery/photos",
        children: [
            {
                name: "Gallery Photos List",
                path: "photos",
                component: Photos,
                meta: { requiresAuth: true }
            },
            {
                name: "Gallery Create Photo",
                path: "photos/create",
                component: Photo,
                meta: { requiresAuth: true }
            },
            {
                name: "Gallery Edit Photo",
                path: "photos/edit/:id",
                component: Photo,
                meta: { requiresAuth: true }
            },
            {
                name: "Gallery Categories List",
                path: "categories",
                component: Categories,
                meta: { requiresAuth: true }
            }
        ]
    }
]
