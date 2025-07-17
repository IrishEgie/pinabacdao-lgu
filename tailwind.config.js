// tailwind.config.js
module.exports = {
  content: ["./*.php", "./**/*.php", "./assets/js/**/*.js"],
  theme: {
    extend: {
      colors: {
        // Include default Tailwind colors
        ...require('tailwindcss/colors'),
        
        fontFamily: {
          sans: ['"Open Sans"', "Arial", "sans-serif"],
        },
        // Brand Colors
        primary: {
          DEFAULT: "#28e060",
          50: "#f0f9f4",
          100: "#d9f0e2",
          200: "#b7e1ca",
          300: "#88cbac",
          400: "#52ae89",
          500: "#28e060",
          600: "#2e7a56",
          700: "#266246",
          800: "#214e3a",
          900: "#1d4031",
          950: "#0c241a",
        },
        secondary: {
          DEFAULT: "#ffa300",
          50: "#f7f6f2",
          100: "#eae7de",
          200: "#d6cfbd",
          300: "#bdb094",
          400: "#a89773",
          500: "#ffa300",
          600: "#7f6b55",
          700: "#685647",
          800: "#58493d",
          900: "#4b3f36",
          950: "#28211c",
        },
        tertiary: {
          DEFAULT: "#66604a",
          50: "#f7f6f1",
          100: "#eae8dc",
          200: "#d7d2bd",
          300: "#c0b897",
          400: "#a99e75",
          500: "#91875e",
          600: "#7a6f51",
          700: "#635943",
          800: "#534b39",
          900: "#484132",
          950: "#262119",
        },
        alternate: {
          DEFAULT: "#c8d7e4",
          50: "#f3f7fa",
          100: "#e7eef5",
          200: "#c8d7e4",
          300: "#a8bed2",
          400: "#7a9cbb",
          500: "#5d80a4",
          600: "#4a6789",
          700: "#3e546f",
          800: "#37485d",
          900: "#323e4e",
          950: "#202833",
        },

        // Utility Colors
        "primary-text": "#0b191e",
        "secondary-text": "#384e58",
        "primary-bg": "#fff1f1",
        "secondary-bg": "#ffffff",

        // Accent Colors
        "accent-1": "rgba(77, 219, 134, 0.42)",
        "accent-2": "rgba(146, 129, 99, 0.42)",
        "accent-3": "rgba(108, 96, 74, 0.42)",
        "accent-4": "rgba(255, 255, 255, 0.80)",

        // Semantic Colors (for priority badges)
        priority: {
          high: "#c4454d",     // Red
          medium: "#f3c344",   // Yellow
          low: "#336a4a",      // Green
        },
        
        // Extended Semantic Colors
        success: "#336a4a",
        error: "#c4454d",
        warning: "#f3c344",
        info: "#ffffff",
      },
      selection: {
        backgroundColor: '#28e060',
        color: '#ffa300',
      },
      animation: {
        'fade-in': 'fadeIn 0.3s ease-out',
      },
      keyframes: {
        fadeIn: {
          from: { opacity: '0', transform: 'translateY(-10px)' },
          to: { opacity: '1', transform: 'translateY(0)' },
        },
      },
      transitionProperty: {
        'chevron': 'transform',
        'dropdown': 'opacity, transform, visibility',
        'underline': 'width',
      },
    },
  },
  plugins: [],
};