/** @type {import('tailwindcss').Config} */
export default {
  darkMode: 'class',
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./node_modules/daisyui/dist/**/*.js"
  ],
  theme: {
    extend: {
      fontFamily: {
        inter: ['Inter', 'sans-serif'],
      },
      colors: {
        hijau: {
          light: '#031C62',
          dark: '#021547',
        },
        biru: {
          light: '#031C62',
          dark: '#021547',
        },
      },
    },
  },
  plugins: [
    require("daisyui")
  ],
  daisyui: {
    themes: ["light", "dark"], // ✅ Pilih tema default
    darkTheme: "dark", // ✅ Force dark theme saat dark mode aktif
    base: true, // ✅ Gunakan style dasar DaisyUI
    styled: true, // ✅ Gunakan komponen styled
  }
}

