/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
  ],
  theme: {
    extend: {
      colors: {
        nakayo: {
          green: '#00261C',
          blue: '#1B2E58',
          orange: '#FF9F29',
          dark: '#2D2D50', 
        }
      },
      // ON AJOUTE LES POLICES ICI
      fontFamily: {
        'sans': ['Poppins', 'Montserrat', 'sans-serif'],
      },
    },
  },
  plugins: [
     require('@tailwindcss/typography'),
  ],
}