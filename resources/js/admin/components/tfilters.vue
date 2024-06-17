<template>
    <div class="is-flex-desktop is-justify-content-flex-end">
        <b-field label="Filtros">
            <b-field group-multiline grouped>
                <b-tooltip label="Limpiar" position="is-left">
                    <b-button icon-left="redo" size="is-small" @click="refresh"></b-button>
                </b-tooltip>

                <b-select v-model="selected" placeholder="Seleccionar opción" size="is-small">
                    <option v-for="(option, i) in options" :key="i" :value="option.value">
                        {{ option.text }}
                    </option>
                </b-select>

                <b-input
                    v-if="isType('text')"
                    v-model="search_text"
                    icon="search"
                    type="search"
                    placeholder="Buscar"
                    icon-right="close-circle"
                    icon-right-clickable
                    size="is-small"
                    @icon-right-click="clearIconClick"
                    @keydown.enter.native="doSearch" />

                <b-datepicker
                    v-if="isType('date')"
                    v-model="search_date_range"
                    placeholder="Seleccionar fechas"
                    icon="calendar-alt"
                    size="is-small"
                    range
                    position="is-bottom-left" />

                <b-select
                    v-if="isType('options')"
                    v-model="search_option"
                    placeholder="Seleccionar opciones"
                    size="is-small"
                    @change.native="doSearch">
                    <option v-for="(option, i) in getOptionsFromSelectedOption" :key="i" :value="option.value">
                        {{ option.text }}
                    </option>
                </b-select>

                <b-select
                    v-if="isType('bool')"
                    v-model="search_bool"
                    placeholder="Seleccionar opciones"
                    size="is-small"
                    @change.native="doSearch">
                    <option v-for="(option, i) in getOptionsFromSelectedOption" :key="i" :value="option.value">
                        {{ option.text }}
                    </option>
                </b-select>

                <b-numberinput
                    v-if="isType('number')"
                    v-model="search_number"
                    :controls="true"
                    controls-position="compact"
                    size="is-small"
                    exponential
                    @keydown.enter.native="doSearch" />

                <b-button icon-left="search" size="is-small" @click="doSearch"> Buscar </b-button>
            </b-field>
        </b-field>
    </div>
</template>

<script>
export default {
    props: {
        options: {
            type: [Object, Array],
            required: true
        },
        storeSelected: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            search_text: "",
            search_date_range: [new Date(), new Date()],
            search_option: "",
            search_bool: 1,
            search_number: 1,
            selected: ""
        }
    },
    computed: {
        getSelectedOption() {
            let index = this.options.findIndex((e) => e.value == this.selected)
            return index != -1 ? this.options[index] : null
        },
        getOptionsFromSelectedOption() {
            if (!this.getSelectedOption) return []
            // return this.getSelectedOption.type != "bool" ? [] : this.getSelectedOption.options
            return this.getSelectedOption.options
        }
    },
    watch: {
        storeSelected(val) {
            this.selected = val
        }
    },
    mounted() {
        this.setDefaultDataState()
        this.selected = this.storeSelected
    },
    methods: {
        setDefaultDataState() {
            this.search_text = ""
            this.search_date_range = [new Date(), new Date(new Date().getTime() + 86400000)]
            this.search_option = ""
            this.search_bool = true
            this.search_number = 1
        },
        getSearch(type) {
            const types = {
                text: () => this.search_text,
                date: () => [
                    this.$dayjs(this.search_date_range[0]).format("YYYY-MM-DD"),
                    this.$dayjs(this.search_date_range[1]).format("YYYY-MM-DD")
                ],
                options: () => this.search_option,
                bool: () => this.search_bool,
                number: () => this.search_number
            }

            return types[type]()
        },
        isType(type) {
            return this.getSelectedOption ? this.getSelectedOption.type == type : true
        },
        doSearch() {
            this.$emit("search", {
                selected: this.getSelectedOption.value,
                search: this.getSearch(this.getSelectedOption.type)
            })
        },
        refresh() {
            this.setDefaultDataState()
            this.selected = this.options[0].value
            this.doSearch()
        },
        changedFilter(index) {
            // NOT USING
            // this.setDefaultDataState()
            this.selected = this.options[index].value
            // this.doSearch()
        },
        clearIconClick() {
            this.search_text = ""
        }
    }
}
</script>
