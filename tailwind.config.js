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
    'williams',
    'aston-martin',
    'alpine'
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
                'alfa-romeo': '#900000',
                'alpha-tauri': '#2B4562',
                'ferrari': '#DC0000',
                'haas': '#FFFFFF',
                'mclaren': '#FF8700',
                'mercedes': '#00D2BE',
                'racing-point': '#F596C8',
                'red-bull-racing': '#0600EF',
                'renault': '#FFF500',
                'williams': '#005AFF',
                'aston-martin': '#006F62',
                'alpine': '#0090FF'
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
