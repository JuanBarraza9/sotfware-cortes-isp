import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/background.css',
                'resources/css/spinner.css',
                'resources/js/app.js',
                'resources/js/loading.js',
            ],
            refresh: true,
        }),
    ],
});
