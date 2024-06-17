import { defineStore } from "pinia"
import { convertDateToString, convertStringToDate, slugify } from "@admin/tools"

const defaultPost = () => {
    return {
        id: "",
        title: "",
        slugurl: "",
        date: new Date(),
        description: "",
        content: "",
        author: "",
        image: "",
        thumb: "",
        publish: false,
        tags: [],
        id_category: null
    }
}

export default defineStore("blog", {
    state: () => ({
        loading: false,
        posts: [],
        pagination: { total: 0, per_page: 20 },
        filters: { search: "", selected: "title", sort_field: "created_at", order: "desc" },
        update_on: false,
        post: defaultPost(),
        errors: [],
        categories: [],
        loading_categories: false,
        loading_upload: false
    }),
    actions: {
        getPosts(url = null) {
            this.loading = true
            let route = !url ? "/blog/posts/get" : url
            return window.axios
                .get(route, {
                    params: this.getFilterParams()
                })
                .then((res) => {
                    this.posts = res.data.data
                    this.pagination = res.data
                    delete this.pagination.data
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        getFilterParams() {
            return {
                selected: this.filters.selected,
                search: this.filters.search,
                sort_field: this.filters.sort_field,
                order: this.filters.order
            }
        },
        getPost(id_post) {
            this.loading = true
            return window.axios
                .get("/blog/posts/get/" + id_post)
                .then((res) => {
                    this.post = res.data
                    this.fixesToPostOnEdit()
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        createPost() {
            this.loading = true
            this.errors = []
            const post = this.clonePostAndPrepare()
            return window.axios
                .post("/blog/posts/create", post)
                .then((res) => {
                    this.loading = false

                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    this.errors = error.response.data.errors
                    throw error
                })
        },
        updatePost() {
            this.loading = true
            this.errors = []
            const post = this.clonePostAndPrepare()
            return window.axios
                .post("/blog/posts/update", post)
                .then((res) => {
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    this.errors = error.response.data.errors
                    throw error
                })
        },
        deletePost(id_post) {
            this.loading = true
            return window.axios
                .post("/blog/posts/delete", {
                    id: id_post
                })
                .then((res) => {
                    this.loading = false
                    let index = this.posts.findIndex((r) => r.id == res.data.id)
                    if (index != -1) this.posts.splice(index, 1)
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        togglePublish(id_post) {
            this.loading = true
            return window.axios
                .post("/blog/posts/publish", {
                    id: id_post
                })
                .then((res) => {
                    this.loading = false
                    let index = this.posts.findIndex((r) => r.id == res.data.id)
                    if (index != -1) this.posts[index].publish = res.data.publish
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        getCategories() {
            this.loading_categories = true
            return window.axios
                .get("/blog/posts/categories")
                .then((res) => {
                    this.categories = res.data
                    this.loading_categories = false
                    return res.data
                })
                .catch((error) => {
                    this.loading_categories = false
                    throw error
                })
        },
        uploadPostImage(file) {
            var form = new FormData()
            form.append("image", file)
            return window.axios
                .post("/blog/posts/image", form, {
                    headers: { "Content-Type": "multipart/form-data" }
                })
                .then((res) => {
                    this.post.image = res.data.path
                    this.post.thumb = res.data.path_thumb
                    return res.data
                })
                .catch((error) => {
                    throw error
                })
        },
        addNewCategoryFromPost(category_name) {
            this.loading_categories = true
            this.errors = []
            return window.axios
                .post("/blog/posts/category", {
                    name: category_name
                })
                .then((res) => {
                    this.loading_categories = false
                    this.categories.unshift(res.data)
                    return res.data
                })
                .catch((error) => {
                    this.loading_categories = false
                    throw error
                })
        },
        cleanForm() {
            this.post = defaultPost()
            this.update_on = false
            this.errors = []
        },
        clonePostAndPrepare() {
            let clonedPost = { ...this.post }
            // Change Date to String
            clonedPost.date = convertDateToString(clonedPost.date)
            // Slug title
            clonedPost.slugurl = slugify(clonedPost.title)
            return clonedPost
        },
        fixesToPostOnEdit() {
            this.post.date = convertStringToDate(this.post.date)
        }
    }
})
