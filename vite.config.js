import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                // user app
                "resources/css/user.css",
                "resources/js/app.js",

                // admin app
                "resources/css/admin.css",
                "resources/js/admin.js",
            ],
            refresh: true,
        }),
    ],
});
