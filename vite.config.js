import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/js/app.js",
                "resources/css/navigation/standard-nav.css",
                "resources/css/welcome/welcome.css",
                "resources/css/helpers.css",
                "resources/css/sections/explore.css",
                "resources/css/products/product-card.css",
                "resources/css/login/login.css",
                "resources/css/products/products.css"
            ],
            refresh: true,
        }),
    ],
});
