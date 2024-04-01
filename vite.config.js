import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    server: {
        host: true,
        port: 5173,
        hmr: {
            clientPort: 5173,
            host: 'localhost',
            protocol: 'ws',
        },
        watch: {
            usePolling: true,
        }
    },
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
                'resources/js/dashboard.app.js',
                'resources/js/assets/main.css',
            ],
            refresh: true,
        }),
    ],
});
