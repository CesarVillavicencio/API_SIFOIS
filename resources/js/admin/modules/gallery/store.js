import { defineStore } from "pinia"

const defaultPhoto = () => {
    return {
        id: "",
        title: "",
        description: "",
        image: "",
        thumb: "",
        id_category: null
    }
}

export default defineStore("gallery", {
    state: () => ({
        loading: false,
        photos: [],
        pagination: { total: 0, per_page: 15 },
        filters: { search: "", selected: "title", sort_field: "created_at", order: "desc" },
        update_on: false,
        photo: defaultPhoto(),
        errors: [],
        categories: [],
        loading_categories: false
    }),
    actions: {
        getPhotos(url = null) {
            this.loading = true
            let route = !url ? "/gallery/photos/get" : url
            return window.axios
                .get(route, {
                    params: this.getFilterParams()
                })
                .then((res) => {
                    this.photos = res.data.data
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
        getPhoto(id_photo) {
            this.loading = true
            return window.axios
                .get("/gallery/photos/get/" + id_photo)
                .then((res) => {
                    this.photo = res.data
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        createPhoto() {
            this.loading = true
            this.errors = []
            return window.axios
                .post("/gallery/photos/create", this.photo)
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
        updatePhoto() {
            this.loading = true
            this.errors = []
            return window.axios
                .post("/gallery/photos/update", this.photo)
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
        deletePhoto(id_photo) {
            this.loading = true
            return window.axios
                .post("/gallery/photos/delete", {
                    id: id_photo
                })
                .then((res) => {
                    this.loading = false
                    let index = this.photos.findIndex((r) => r.id == res.data.id)
                    if (index != -1) this.photos.splice(index, 1)
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
                .get("/gallery/photos/categories")
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
        uploadPhotoImage(file) {
            var form = new FormData()
            form.append("image", file)
            return window.axios
                .post("/gallery/photos/image", form, {
                    headers: { "Content-Type": "multipart/form-data" }
                })
                .then((res) => {
                    this.photo.image = res.data.path
                    this.photo.thumb = res.data.path_thumb
                    return res.data
                })
                .catch((error) => {
                    throw error
                })
        },
        addNewCategoryFromPhoto(category_name) {
            this.loading_categories = true
            this.errors = []
            return window.axios
                .post("/gallery/photos/category", {
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
            this.photo = defaultPhoto()
            this.update_on = false
            this.errors = []
        }
    }
})
