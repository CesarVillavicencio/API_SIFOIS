import { defineConfig } from 'vite'
import laravel from 'laravel-vite-plugin'
import vue from '@vitejs/plugin-vue2'

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/js/admin/app.js',
                // 'resources/js/users/app.js'
            ],
            refresh: false
        }),
        vue()
    ],
    optimizeDeps: {
        include: ['vue', 'vue-router', 'pinia'],
    },
    resolve: {
        alias: {
            '@': '/resources',
            '@admin': '/resources/js/admin',
        }
    }
})
