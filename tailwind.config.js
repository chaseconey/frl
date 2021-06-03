const defaultTheme = require('tailwindcss/defaultTheme')

const teams = [
    'alfa-romeo',
    'alpha-tauri',
    'ferrari',
    'haas',
    'mclaren',
    'mercedes',
    'racing-point',
    'red-bull-racing',
    'renault',
    'williams'
]

module.exports = {
    purge: {
        content: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './app/View/Components/*.php'],
        options: {
            safelist: [
                ...teams.map(team => `border-${team}`),
            ]
        }
    },

    darkMode: 'media',

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            borderColor: {
                'alfa-romeo': '#9B0000',
                'alpha-tauri': '#FFFFFF',
                'ferrari': '#C80000',
                'haas': '#787878',
                'mclaren': '#FF8700',
                'mercedes': '#00D2BE',
                'racing-point': '#F596C8',
                'red-bull-racing': '#1E41FF',
                'renault': '#FFF500',
                'williams': '#0082FA',
            }
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
}
