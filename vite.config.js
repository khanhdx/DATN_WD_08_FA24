import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/chat.js',
                "resources/js/bootstrap.js",
                "resources/js/order-noti.js",
                "resources/js/shipping.js",
                "resources/js/crud-images.js",
            ],
            refresh: true,
        }),
    ],
});
