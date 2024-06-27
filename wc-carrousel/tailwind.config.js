/** @type {import('tailwindcss').Config} */
module.exports = {
  important: true,
  content: ["./src/**/*.{php,js}","./node_modules/tw-elements/js/**/*.js"
],
  theme: {
    extend: {},
  },
  plugins: [require("tw-elements/plugin.cjs")],
}