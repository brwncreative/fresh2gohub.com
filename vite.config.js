import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/searchbar.css",
                "resources/css/tags.css",
                "resources/css/carousel.css",
                "resources/css/menu.css",
                "resources/js/app.js"
            ],
            refresh: true,
        }),
    ],
});
