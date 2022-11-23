const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.ts',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
