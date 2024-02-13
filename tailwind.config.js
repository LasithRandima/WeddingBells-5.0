import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';
import preset from './vendor/filament/support/tailwind.config.preset'
import colors from 'tailwindcss/colors';

//  @type {import('tailwindcss').Config}
export default {
    presets: [preset],

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './app/Filament/**/*.php',
        './resources/views/filament/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './app/Http/Livewire/**/*Table.php',
        './vendor/awcodes/overlook/resources/**/*.blade.php',
        './vendor/awcodes/filament-tiptap-editor/resources/**/*.blade.php',
        '/vendor/awcodes/overlook/resources/**/*.blade.php',
        '/vendor/awcodes/filament-quick-create/resources/**/*.blade.php',

    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
                // Include custom colors directly in the extend block
                gold: {
                  '50': '#f9f5e8',
                  '100': '#f4ebd1',
                  // Add more shades as needed
                },
                champagne: {
                  '50': '#fff9f4',
                  '100': '#fff3e8',
                  // Add more shades as needed
                },
                lavender: {
                  '50': '#f3ebf6',
                  '100': '#e8d7ec',
                  // Add more shades as needed
                },
                mauve: {
                  '50': '#f8f2f8',
                  '100': '#eeddec',
                  // Add more shades as needed
                },
                royalPurple: {
                  '50': '#f6f1fa',
                  '100': '#edebfa',
                  // Add more shades as needed
                },
                // Add more custom color categories as needed
              },

        },
    },

    plugins: [forms, typography],

};
