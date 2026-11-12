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
        ink: "#101828",
        muted: "#475467",
        line: "#E4E7EC",
        field: "#8A94A6",
        canvas: "#F7F8FA",
        surface: "#FFFFFF",
        brand: {
          50: "#EEF2FF",
          100: "#E0E7FF",
          200: "#C7D2FE",
          500: "#2447F9",
          600: "#1D3FE0",
          700: "#1733B8",
          800: "#122A94",
        },
        success: {
          50: "#ECFDF3",
          100: "#D1FADF",
          200: "#A6F4C5",
          600: "#067647",
          700: "#05603A",
        },
        warning: {
          50: "#FFFAEB",
          100: "#FEF0C7",
          200: "#FEDF89",
          600: "#B54708",
          700: "#93370D",
        },
        danger: {
          50: "#FEF3F2",
          100: "#FEE4E2",
          200: "#FECDCA",
          500: "#D92D20",
          600: "#B42318",
          700: "#912018",
        },
      },
      fontFamily: {
        sans: ['"Geist"', "ui-sans-serif", "system-ui", "sans-serif"],
        display: ['"Geist"', "ui-sans-serif", "system-ui", "sans-serif"],
      },
      boxShadow: {
        card: "0 1px 2px rgba(16, 24, 40, 0.05), 0 1px 3px rgba(16, 24, 40, 0.10)",
        lift: "0 12px 24px -12px rgba(16, 24, 40, 0.25)",
      },
      keyframes: {
        "fade-up": {
          "0%": { opacity: "0", transform: "translateY(6px)" },
          "100%": { opacity: "1", transform: "translateY(0)" },
        },
      },
      animation: {
        "fade-up": "fade-up 240ms ease-out both",
      },
    },
  },
  plugins: [],
}
