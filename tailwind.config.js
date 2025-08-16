// tailwind.config.js
module.exports = {
  content: [
    './*.php',
    './**/*.php',
    './assets/js/**/*.js',
    './wp-content/themes/pinabacdao-lgu/**/*.php'
  ],
  theme: {
    extend: {
      colors: {
        // Include default Tailwind colors
        ...require('tailwindcss/colors'),
        
        fontFamily: {
          sans: ['"Open Sans"', "Arial", "sans-serif"],
        },

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

        // ALTERNATE: Filipino Flag Blue (Peace & Truth) - Lighter variant
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

        // Accent Colors with Filipino theme
        "accent-1": "rgba(24, 119, 242, 0.1)",  // Facebook blue tint
        "accent-2": "rgba(206, 17, 38, 0.1)",   // Red tint
        "accent-3": "rgba(252, 209, 22, 0.1)",  // Yellow/Gold tint
        "accent-4": "rgba(0, 56, 168, 0.1)",    // Deep blue tint

        // Semantic Colors aligned with Filipino flag theme
        priority: {
          high: "#ce1126",     // Flag Red for urgent/high priority
          medium: "#fcd116",   // Flag Yellow for medium priority
          low: "#1877f2",     // Facebook Blue for low priority
        },
        
        // Extended Semantic Colors
        success: "#16a34a",   // Clean green for success states
        error: "#ce1126",     // Flag red for errors
        warning: "#fcd116",   // Flag yellow for warnings
        info: "#1877f2",      // Facebook blue for info
        
        // Special LGU Colors
        government: {
          DEFAULT: "#0038a8",  // Official government blue
          light: "#3b82f6",
          dark: "#1e3a8a",
        },
        
        heritage: {
          DEFAULT: "#8b5a2b",  // Brown representing Filipino heritage
          light: "#d2691e",
          dark: "#654321",
        },
      },

      // Enhanced selection styling
      selection: {
        backgroundColor: '#1877f2',
        color: '#ffffff',
      },

      // Smooth animations
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

      // Enhanced transitions
      transitionProperty: {
        'all-smooth': 'all',
        'colors-smooth': 'color, background-color, border-color, text-decoration-color, fill, stroke',
        'transform-smooth': 'transform, opacity',
      },

      transitionDuration: {
        '250': '250ms',
        '350': '350ms',
      },

      // Box shadows with Filipino flag colors
      boxShadow: {
        'primary': '0 4px 14px 0 rgba(24, 119, 242, 0.15)',
        'secondary': '0 4px 14px 0 rgba(206, 17, 38, 0.15)',
        'tertiary': '0 4px 14px 0 rgba(252, 209, 22, 0.15)',
        'government': '0 4px 14px 0 rgba(0, 56, 168, 0.15)',
        'soft': '0 2px 8px 0 rgba(0, 0, 0, 0.08)',
        'medium': '0 4px 16px 0 rgba(0, 0, 0, 0.12)',
        'strong': '0 8px 24px 0 rgba(0, 0, 0, 0.15)',
      },

      // Gradient backgrounds
      backgroundImage: {
        'flag-gradient': 'linear-gradient(135deg, #1877f2 0%, #0038a8 50%, #ce1126 100%)',
        'hero-gradient': 'linear-gradient(135deg, #1877f2 0%, #fcd116 100%)',
        'sunset-gradient': 'linear-gradient(135deg, #fcd116 0%, #ce1126 100%)',
      },
    },
  },
  plugins: [],
};

/* 
COLOR PALETTE REFERENCE:
========================

Primary Colors (Main Usage):
- primary-500: #1877f2 (Facebook Blue) - Main brand color, buttons, links
- secondary-500: #ce1126 (Flag Red) - Important actions, alerts, CTAs  
- tertiary-500: #fcd116 (Flag Yellow) - Highlights, accents, success states
- alternate-500: #0038a8 (Deep Flag Blue) - Headers, official elements

Usage Guidelines:
- Use primary (Facebook blue) for main navigation, primary buttons, and links
- Use secondary (red) sparingly for important actions and alerts
- Use tertiary (yellow/gold) for highlights, badges, and positive feedback
- Use alternate (deep blue) for official government sections
- Maintain good contrast ratios for accessibility

Filipino Flag Symbolism:
- Blue: Peace, truth, and justice
- Red: Patriotism and valor  
- Yellow: Wealth and sovereignty
- White: Equality and fraternity (represented in our neutral colors)
*/