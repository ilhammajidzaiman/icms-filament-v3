/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "<path-to-vendor>/solution-forest/filament-tree/resources/**/*.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [],
};
