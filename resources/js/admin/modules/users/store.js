import { defineStore } from "pinia"

const defaultUser = () => {
    return {
        id: "",
        name: "",
        lastname: "",
        email: "",
        avatar: "",
        type: "admin"
    }
}

const defaultPassword = () => {
    return {
        password: "",
        password_confirmation: ""
    }
}

export default defineStore("users", {
    state: () => ({
        loading: false,
        users: [],
        pagination: { total: 0, per_page: 20 },
        filters: { search: "", selected: "name", sort_field: "created_at", order: "desc" },
        update_on: false,
        user: defaultUser(),
        password: defaultPassword(),
        errors: []
    }),
    actions: {
        getUsers(url = null) {
            this.loading = true
            let route = url == null ? "/users/get" : url
            return window.axios
                .get(route, {
                    params: this.getFilterParams()
                })
                .then((res) => {
                    this.users = res.data.data
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
        getUser(id_user) {
            this.loading = true
            return window.axios
                .get("/users/get/" + id_user)
                .then((res) => {
                    this.user = res.data
                    this.loading = false
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        createUser() {
            this.loading = true
            this.errors = []
            return window.axios
                .post("/users/create", {
                    ...this.user,
                    ...this.password
                })
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
        updateUser() {
            this.loading = true
            this.errors = []
            return window.axios
                .post("/users/update", this.user)
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
        deleteUser(id_user) {
            this.loading = true
            return window.axios
                .post("/users/delete", {
                    id: id_user
                })
                .then((res) => {
                    this.loading = false
                    let index = this.users.findIndex((r) => r.id == res.data.id)
                    if (index != -1) this.users.splice(index, 1)
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        toggleBlock(id_user) {
            this.loading = true
            return window.axios
                .post("/users/block", {
                    id: id_user
                })
                .then((res) => {
                    this.loading = false
                    let index = this.users.findIndex((r) => r.id == res.data.id)
                    if (index != -1) this.users[index].blocked_at = res.data.blocked_at
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    throw error
                })
        },
        uploadAvatar(file) {
            var form = new FormData()
            form.append("image", file)
            return window.axios
                .post("/users/avatar", form, {
                    headers: { "Content-Type": "multipart/form-data" }
                })
                .then((res) => {
                    this.user.avatar = res.data
                    return res.data
                })
                .catch((error) => {
                    throw error
                })
        },
        updatePassword() {
            this.loading = true
            this.errors = []
            return window.axios
                .post("/users/password", {
                    id: this.user.id,
                    ...this.password
                })
                .then((res) => {
                    this.loading = false
                    this.password.password = ""
                    this.password.password_confirmation = ""
                    return res.data
                })
                .catch((error) => {
                    this.loading = false
                    this.errors = error.response.data.errors
                    throw error
                })
        },
        cleanForm() {
            this.user = defaultUser()
            this.password = defaultPassword()
            this.update_on = false
            this.errors = []
        }
    }
})
