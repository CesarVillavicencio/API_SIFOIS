module.exports = {
    env: {
        node: true,
    },
    extends: [
        'eslint:recommended',
        'plugin:vue/essential',
        'plugin:vue/strongly-recommended',
        'plugin:vue/recommended',
        'prettier'
    ],
    rules: {
        // override/add rules settings here, such as:
        // 'vue/no-unused-vars': 'error'
        'vue/multi-word-component-names': 'off',
        'vue/component-definition-name-casing': 'off'
    }
}
