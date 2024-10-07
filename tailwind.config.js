import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import preset from './vendor/filament/support/tailwind.config.preset'
const colors = require('tailwindcss/colors')

/** @type {import('tailwindcss').Config} */
export default {
  presets: [preset],
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './app/Filament/**/*.php',
    './resources/views/filament/**/*.blade.php',
    './vendor/filament/**/*.blade.php',
  ],
  theme: {
    container: {
      center: true,
      padding: {
        DEFAULT: '1rem',
        xl: '2rem'
      }
    },
    extend: {
      fontFamily: {
        sans: ['Poppins', ...defaultTheme.fontFamily.sans],
      },
      colors: {
        background: colors.gray[50],
        foreground: colors.gray[700],
        primary: {DEFAULT: '#659bad', foreground: colors.gray[100]},
        muted: {DEFAULT: colors.gray[100]}
      }
    },
  },

  plugins: [forms, require('@tailwindcss/typography'),],
};
