import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        // Ensure development server uses HTTPS
        https: false,
        hmr: {
            host: 'localhost',
            port: 5173,
        },
    },
    build: {
        // Ensure production build works correctly
        outDir: 'public/build',
        emptyOutDir: true,
    },
});
