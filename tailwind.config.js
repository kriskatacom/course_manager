export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        primary: "#2563eb"
      }
    },
  },
  safelist: [
    'bg-gray-600', 'text-gray-100',
    'bg-green-600', 'text-gray-100',
    'bg-yellow-600', 'text-yellow-100',
    'bg-red-600', 'text-red-100',
    'bg-blue-600', 'text-blue-100',
  ],
  plugins: [],
}