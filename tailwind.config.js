module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {},
    },
    safelist: [
        {
            pattern: /(bg|text|border)-(.*)-(200|300|400|500)/,
        }
    ],
    plugins: [
        require("@tailwindcss/forms"),
    ],
};