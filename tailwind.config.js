import defaultTheme from 'tailwindcss/defaultTheme';

module.exports = {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './config/blade-components.php'
    ],
    darkMode: 'class',
    theme: {
        container: {
            center: true,
            padding: '1.5rem',
        },
        extend: {
            colors: {
                'primary-red': '#FE3448',
                'secondary-pink': '#E82399',
                'light-gray': '#F2F2F2',
                'medium-gray': '#D6D6D6',
                'dark-gray-1': '#BBBBBB',
                'dark-gray-2': '#999999',
                'almost-black': '#0D0D0D',
            },
            fontFamily: {
                sans: ['Larsseit', ...defaultTheme.fontFamily.sans],
            }
        },

    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
