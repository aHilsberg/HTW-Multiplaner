import {defineConfig} from 'vite';
import laravel from 'vite-plugin-laravel'
import vue from '@vitejs/plugin-vue';

import tailwindcss from "tailwindcss";
import autoprefixer from "autoprefixer";
import AutoImport from 'unplugin-auto-import/vite'
import inertiaLayout from "./resources/scripts/vite/inertia-layout";

export default defineConfig({
    plugins: [
        inertiaLayout(),
        laravel({
            postcss: [tailwindcss(), autoprefixer()],
        }),
        vue(),
        AutoImport({
            presetOverriding: true,
            imports: [
                'vue',
                '@vueuse/core',
                {
                    '@inertiajs/inertia': ['Inertia'],
                    '@inertiajs/inertia-vue3': ['useRemember', 'usePage', 'useForm'],
                },
            ],
        }),
    ],
    publicDir: 'public'
});
