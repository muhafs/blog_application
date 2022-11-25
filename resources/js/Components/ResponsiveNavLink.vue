<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
	props.active
		? "block pl-3 pr-4 py-2 border-l-4 border-secondary text-base font-medium text-primary bg-ghost focus:outline-none focus:text-primary/70 focus:bg-ghost/80 focus:border-secondary/80 transition duration-150 ease-in-out"
		: "block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-secondary hover:text-primary hover:bg-ghost hover:border-secondary focus:outline-none focus:text-primary/70 focus:bg-ghost/80 focus:border-secondary/80 transition duration-150 ease-in-out"
);
</script>

<template>
	<Link :href="href" :class="classes">
		<slot />
	</Link>
</template>
