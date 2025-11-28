import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        // PENTING: Agar bisa diakses dari Windows (Host)
        host: '0.0.0.0', 
        
        // Port internal container (JANGAN UBAH INI)
        port: 5173,      
        
        // Konfigurasi HMR (Hot Module Replacement)
        hmr: {
            host: 'localhost',
            clientPort: 3000, // <--- Ini kuncinya! Browser lapor ke port 3000
        },
        
        // Izinkan akses lintas domain
        cors: true,
    },
});