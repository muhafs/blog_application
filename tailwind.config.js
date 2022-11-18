const defaultTheme = require("tailwindcss/defaultTheme");

/** @type {import('tailwindcss').Config} */
module.exports = {
	content: [
		"./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
		"./storage/framework/views/*.php",
		"./resources/views/**/*.blade.php",
		"./resources/js/**/*.vue",
	],

	theme: {
		extend: {
			fontFamily: {
				sans: ["Nunito", ...defaultTheme.fontFamily.sans],
			},
			colors: {
				primary: "#0A1931",
				secondary: "#FFC947",
				tertiary: "#185ADB",
				ghost: "#EFEFEF",
			},
		},
	},

	plugins: [require("@tailwindcss/forms")],
};
