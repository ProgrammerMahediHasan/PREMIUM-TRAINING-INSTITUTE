/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",
    "./src/**/*.{vue,js}"
  ],
  theme: {
    extend: {
      fontFamily: {
        nav: ["Poppins", "ui-sans-serif", "system-ui", "Segoe UI", "Roboto", "Helvetica Neue", "Arial", "sans-serif"]
      },
      colors: {
        navy: {
          DEFAULT: "#0a2540"
        },
        cream: {
          DEFAULT: "#fdf4e2"
        },
        primary: {
          DEFAULT: "#06BBCC",
          dark: "#089EB0",
          light: "#7AD7DF"
        },
        secondary: {
          DEFAULT: "#FE5D37",
          dark: "#DC5131",
          light: "#FF8A6F"
        }
      }
    }
  },
  plugins: []
}
