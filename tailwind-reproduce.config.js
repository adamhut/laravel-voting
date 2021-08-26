const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')


module.exports = {
    // mode: 'jit',

    purge: [
        // './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        // './storage/framework/views/*.php',
        // './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            spacing: {
                'table': "2560px",
                '128'  : "32rem"
            },
        },
    },
    // variants: {
    //     extend: {},
    // },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/line-clamp'),
    ],
};
