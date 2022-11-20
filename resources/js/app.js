import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp, Head, Link } from "@inertiajs/inertia-vue3";
import { InertiaProgress } from "@inertiajs/progress";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import AuthLayoutVue from "@/Layouts/AuthLayout.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";

const appName =
	window.document.getElementsByTagName("title")[0]?.innerText || "Laravel";

createInertiaApp({
	title: (title) => `${title} - ${appName}`,
	resolve: async (name) => {
		const page = await resolvePageComponent(
			`./Pages/${name}.vue`,
			import.meta.glob("./Pages/**/*.vue")
		);

		if (name.startsWith("Admin")) {
			page.default.layout = AuthLayoutVue;
		} else {
			page.default.layout = GuestLayout;
		}

		// console.log(name);

		return page;
	},
	setup({ el, app, props, plugin }) {
		return createApp({ render: () => h(app, props) })
			.use(plugin)
			.use(ZiggyVue, Ziggy)
			.component("Head", Head)
			.component("Link", Link)
			.mount(el);
	},
});

InertiaProgress.init({ color: "#FFC947" });
