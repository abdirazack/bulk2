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
                mytheme: {
                  "primary": "#a991f7",
                  "secondary": "#f6d860",
                  "accent": "#37cdbe",
                  "neutral": "#3d4451",
                  "base-100": "#ffffff",
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
