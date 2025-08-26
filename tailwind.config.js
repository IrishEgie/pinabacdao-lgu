// tailwind.config.js - Production Optimized
module.exports = {
  content: [
    // Be more specific to improve purging
    './*.php',
    './template-parts/**/*.php',
    './includes/**/*.php',
    // JavaScript files
    './src/**/*.js',
    './build/*.js', // Include built files
    // Avoid scanning unnecessary files
    '!./node_modules',
    '!./build/static'
  ],
  theme: {
    extend: {
      colors: {
        // Keep your existing color configuration
        // PRIMARY: Facebook Blue (Main Brand Color)
        primary: {
          DEFAULT: "#1877f2",
          50: "#eff6ff",
          100: "#dbeafe", 
          200: "#bfdbfe",
          300: "#93c5fd",
          400: "#60a5fa",
          500: "#1877f2",
          600: "#1565c0",
          700: "#1e40af",
          800: "#1e3a8a",
          900: "#1e3a8a",
          950: "#0f172a",
        },

        // SECONDARY: Filipino Flag Red (Courage & Patriotism)
        secondary: {
          DEFAULT: "#fcd116",
          50: "#fefce8",
          100: "#fef9c3",
          200: "#fef08a",
          300: "#fde047",
          400: "#fcd116",
          500: "#eab308",
          600: "#ca8a04",
          700: "#a16207",
          800: "#854d0e",
          900: "#713f12",
          950: "#422006",
        },

        // TERTIARY: Filipino Flag Yellow/Gold (Peace & Noble Ideals)
        tertiary: {
          DEFAULT: "#ce1126",
          50: "#fef2f2",
          100: "#fee2e2",
          200: "#fecaca",
          300: "#fca5a5",
          400: "#f87171",
          500: "#ce1126",
          600: "#b91c1c",
          700: "#991b1b",
          800: "#7f1d1d",
          900: "#7c2d12",
          950: "#450a0a",
        },

        // ALTERNATE: Filipino Flag Blue (Peace & Truth)
        alternate: {
          DEFAULT: "#0038a8",
          50: "#eff6ff",
          100: "#dbeafe",
          200: "#bfdbfe",
          300: "#93c5fd",
          400: "#60a5fa",
          500: "#0038a8",
          600: "#1d4ed8",
          700: "#1e40af",
          800: "#1e3a8a",
          900: "#1e3a8a",
          950: "#0f172a",
        },

        // NEUTRAL: Clean whites and grays for balance
        neutral: {
          DEFAULT: "#6b7280",
          50: "#f9fafb",
          100: "#f3f4f6",
          200: "#e5e7eb",
          300: "#d1d5db",
          400: "#9ca3af",
          500: "#6b7280",
          600: "#4b5563",
          700: "#374151",
          800: "#1f2937",
          900: "#111827",
          950: "#030712",
        },

        // Utility Colors
        "primary-text": "#1f2937",
        "secondary-text": "#4b5563",
        "primary-bg": "#ffffff",
        "secondary-bg": "#f9fafb",

        // Semantic Colors
        success: "#16a34a",
        error: "#ce1126",
        warning: "#fcd116",
        info: "#1877f2",
        
        // LGU Colors
        government: {
          DEFAULT: "#0038a8",
          light: "#3b82f6",
          dark: "#1e3a8a",
        },
        
        heritage: {
          DEFAULT: "#8b5a2b",
          light: "#d2691e",
          dark: "#654321",
        },
      },

      fontFamily: {
        sans: ['"Open Sans"', "Arial", "sans-serif"],
      },

      // Animations
      animation: {
        'fade-in': 'fadeIn 0.4s ease-out',
        'slide-up': 'slideUp 0.3s ease-out',
        'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
      },

      keyframes: {
        fadeIn: {
          from: { opacity: '0', transform: 'translateY(-10px)' },
          to: { opacity: '1', transform: 'translateY(0)' },
        },
        slideUp: {
          from: { opacity: '0', transform: 'translateY(20px)' },
          to: { opacity: '1', transform: 'translateY(0)' },
        },
      },

      // Box shadows
      boxShadow: {
        'primary': '0 4px 14px 0 rgba(24, 119, 242, 0.15)',
        'secondary': '0 4px 14px 0 rgba(206, 17, 38, 0.15)',
        'tertiary': '0 4px 14px 0 rgba(252, 209, 22, 0.15)',
        'government': '0 4px 14px 0 rgba(0, 56, 168, 0.15)',
        'soft': '0 2px 8px 0 rgba(0, 0, 0, 0.08)',
        'medium': '0 4px 16px 0 rgba(0, 0, 0, 0.12)',
        'strong': '0 8px 24px 0 rgba(0, 0, 0, 0.15)',
      },

      // Gradients
      backgroundImage: {
        'flag-gradient': 'linear-gradient(135deg, #1877f2 0%, #0038a8 50%, #ce1126 100%)',
        'hero-gradient': 'linear-gradient(135deg, #1877f2 0%, #fcd116 100%)',
        'sunset-gradient': 'linear-gradient(135deg, #fcd116 0%, #ce1126 100%)',
      },
    },
  },
  plugins: [
    // Add useful plugins for production
    // Uncomment if you install them:
    // require('@tailwindcss/typography'),
    // require('@tailwindcss/forms'),
    // require('@tailwindcss/aspect-ratio'),
  ],
  
  // Production optimizations
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
  },
  
  // Disable unused features to reduce bundle size
  corePlugins: {
    // Enable all by default, disable only if you're sure you don't need them
    // container: false,
    // accessibility: false,
  },
};