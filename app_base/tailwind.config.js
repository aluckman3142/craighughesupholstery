const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    important: true,
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            backgroundImage: {
                'barstool': "url('/img/barstool.jpg')",
                'headboard': "url('/img/pink-headboard.jpg')",
                'chaise': "url('/img/chaise.jpg')",
                'heading': "url('/img/heading-background.jpeg')",
                'classes-heading': "url('/img/classes-heading-background.jpg')",
                'accommodation-heading': "url('/img/accommodation-bg.jpg')",
                'fabrics': "url('/img/fabrics-bg.jpg')",
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
