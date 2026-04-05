import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                // Kita daftarkan warna kustom untuk Votech Skanawa
                'navy': {
                    DEFAULT: '#1B365D',
                    light: '#2E5A9E',
                    dark: '#0F213F',
                },
                'skyblue': {
                    DEFAULT: '#0EA5E9',
                    light: '#7DD3FC',
                    dark: '#0369A1',
                }
            }
        },
    },

    plugins: [forms],
};