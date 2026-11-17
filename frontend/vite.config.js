import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/css/global.css',
                'resources/css/ai-assistant.css',
                'resources/css/analytics.css',
                'resources/css/report.css',
                'resources/css/costcalculator.css',
                'resources/css/dashboard.css',
                'resources/css/management.css',
                'resources/js/app.js',
                'resources/js/ai-assistant.js',
                'resources/js/analytics.js',
                'resources/js/report.js',
                'resources/js/costcalculator.js',
                'resources/js/dashboard.js',
                'resources/js/management.js',
            ],
            refresh: true,
        }),
    ],
});
