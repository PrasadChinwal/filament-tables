import { defineConfig } from 'vite';
import laravel, { refreshPaths } from 'laravel-vite-plugin';
import vue from "@vitejs/plugin-vue";

import vuetify from 'vite-plugin-vuetify'
import postcss from './postcss.config.cjs'

export default defineConfig({
    build: { chunkSizeWarningLimit: 1600, },
    server: {
        port: 5173,
        https: {
            key: '/etc/ssl/private/wildcard_key.key',
            cert: '/etc/ssl/certs/wildcard_cert.cer',
        },
        host: 'apps.uis.edu',
    },
    css: {
        postcss,
    },
    plugins: [
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
        vuetify({ autoImport: true }),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                ...refreshPaths,
                'app/Livewire/**',
            ],
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
