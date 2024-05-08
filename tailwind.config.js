import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wire-elements/modal/src/ModalComponent.php',
    ],
    

    presets: [require("./vendor/power-components/livewire-powergrid/tailwind.config.js"),],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
        },
       
    },

    plugins: [require("daisyui"),forms],

    daisyui: {
        themes: true, 
        darkTheme: "cupcake", 
        base: true, 
        styled: true, 
        utils: true, 
        prefix: "",
        logs: true,
        themeRoot: ":root",
      },
      daisyui: {
        themes: [
            {
              somxchange: {
                "primary": "#2563eb",
                "secondary": "#44403c",
                "accent": "#3730a3",
                "neutral": "#164e63",
                "base-100": "#ffedd5",
                "info": "#67e8f9",
                "success": "#16a34a",
                "warning": "#f59e0b",
                "error": "#dc2626",
                },
              },
          "light",
          "dark",
          "cupcake",
          "bumblebee",
          "emerald",
          "corporate",
          "synthwave",
          "retro",
          "cyberpunk",
          "valentine",
          "halloween",
          "garden",
          "forest",
          "aqua",
          "lofi",
          "pastel",
          "fantasy",
          "wireframe",
          "black",
          "luxury",
          "dracula",
          "cmyk",
          "autumn",
          "business",
          "acid",
          "lemonade",
          "night",
          "coffee",
          "winter",
          "dim",
          "nord",
          "sunset",
        ],},
};
