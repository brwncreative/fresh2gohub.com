import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/js/app.js",
                "resources/css/dashboard/dashboard.css",
                "resources/css/sections/sections.css",
                "resources/css/navigation/standard-nav.css",
                "resources/css/welcome/welcome.css",
                "resources/css/helpers.css",
                "resources/css/products/product-card.css",
                "resources/css/login/login.css",
                "resources/css/products/products.css",
                "resources/css/results/results.css",
                "resources/css/checkout/cart.css",
                "resources/css/app.css",
            ],
            refresh: true,
        }),
    ],
});
