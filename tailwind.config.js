import defaultTheme from "tailwindcss/defaultTheme";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "node_modules/preline/dist/*.js",
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ["Poppins", ...defaultTheme.fontFamily.sans], // For English (default)
                arabic: ["Cairo", "Arial", "sans-serif"], // For Arabic
                crimson: ["Crimson Pro", ...defaultTheme.fontFamily.sans],
                IBM: ["IBM Plex Sans Arabic", "Arial", "sans-serif"],
            },
        },
    },
    plugins: [require("preline/plugin")],
};
