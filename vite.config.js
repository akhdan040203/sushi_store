import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/welcome.css',
                'resources/css/homepage-v5.css',
                'resources/css/service.css',
                'resources/css/profile-menu.css',
                'resources/js/app.js',
                'resources/js/homepage.js'
            ],
            refresh: true,
        }),
    ],
});
