const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require('tailwindcss/colors')

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
    safelist: [
        ...teams.map(team => `border-${team}`),
    ],
    content: ['./storage/framework/views/*.php', './resources/views/**/*.blade.php', './app/View/Components/*.php'],

    theme: {
        extend: {
            colors: {
                green: colors.emerald,
                yellow: colors.amber,
                purple: colors.violet,
            },
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

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
}
