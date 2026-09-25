/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    darkMode: 'class',
    theme: {
        extend: {
            colors: {
                brand: {
                    50: '#f0f7ff',
                    100: '#e0effe',
                    200: '#bae0fd',
                    300: '#7cc7fb',
                    400: '#38a8f7',
                    500: '#0e8ce9',
                    600: '#026fc7',
                    700: '#0358a1',
                    800: '#074b84',
                    900: '#0c3f6e',
                    950: '#082848',
                },
                gold: {
                    50: '#fffbeb',
                    100: '#fef3c7',
                    200: '#fde68a',
                    300: '#fcd34d',
                    400: '#fbbf24',
                    500: '#f59e0b',
                    600: '#d97706',
                    700: '#b45309',
                    800: '#92400e',
                    900: '#78350f',
                },
                emerald: {
                    500: '#10b981',
                    600: '#059669',
                }
            },
            fontFamily: {
                sans: ['Outfit', 'Plus Jakarta Sans', 'Inter', 'sans-serif'],
                display: ['Plus Jakarta Sans', 'Outfit', 'sans-serif'],
            },
            boxShadow: {
                'glass': '0 8px 32px 0 rgba(31, 38, 135, 0.07)',
                'glass-glow': '0 0 25px -5px rgba(14, 140, 233, 0.3)',
                'card-hover': '0 20px 35px -10px rgba(0, 0, 0, 0.08), 0 10px 10px -5px rgba(0, 0, 0, 0.02)',
            }
        },
    },
    plugins: [],
};
