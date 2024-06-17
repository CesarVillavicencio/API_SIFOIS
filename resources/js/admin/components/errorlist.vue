<template>
    <b-notification v-if="errors.length != 0" type="is-danger" has-icon aria-close-label="Remover" role="alert">
        <ul>
            <li v-for="(error, i) in errors" :key="i">
                {{ error[0] }}
            </li>
        </ul>
    </b-notification>
</template>

<script>
export default {
    props: {
        errors: {
            type: [Array, Object],
            required: true
        }
    }
}
</script>
