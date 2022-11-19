<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps(["href", "active"]);

const classes = computed(() =>
	props.active
		? "inline-flex items-center px-1 pt-1  border-b-4 border-secondary text-sm font-medium leading-5 text-secondary focus:outline-none focus:border-secondary/80 transition  duration-150 ease-in-out"
		: "inline-flex items-center px-1 pt-1  border-b-4 border-transparent text-sm font-medium leading-5 text-ghost hover:text-ghost/50 hover:border-ghost focus:outline-none focus:text-ghost/50 focus:border-gray-300 transition duration-150 ease-in-out"
);
</script>

<template>
	<Link :href="href" :class="classes">
		<slot />
	</Link>
</template>
