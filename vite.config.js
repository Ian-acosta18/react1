import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import react from '@vitejs/plugin-react'; // <-- Importar el plugin

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.jsx'], // <-- Cambiar .js a .jsx
            refresh: true,
        }),
        react(), // <-- Agregar el plugin aquí
    ],
});