/** @type {import('tailwindcss').Config} */
export default {
  prefix: 'tw-',
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
  ],
  corePlugins: {
    preflight: false, // Bootstrap handles base reset; skip Tailwind's to avoid conflicts
  },
  theme: {
    extend: {
      colors: {
        primary: '#4f46e5',
        'primary-hover': '#4338ca',
      },
      backdropBlur: {
        xs: '2px',
      },
    },
  },
  plugins: [],
}
