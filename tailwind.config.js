/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        colors: {
          orange: {
            500: '#FF6B35',
            600: '#E65A2B',
          },
          gray: {
            50: '#F9FAFB',
            100: '#F3F4F6',
            200: '#E5E7EB',
            700: '#374151',
            800: '#1F2937',
            900: '#111827',
          }
        }
      }
    },
    plugins: [],
  }
  