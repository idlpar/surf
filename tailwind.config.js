/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/views/**/*.blade.php", // Scans all Blade files in the views folder
    "./resources/js/**/*.js",          // Includes JavaScript files in the js folder
    "./resources/**/*.vue",            // Includes Vue files, if you're using Vue
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

