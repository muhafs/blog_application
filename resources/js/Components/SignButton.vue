<template>
	<Link
		:href="url"
		class="rounded-full bg-secondary py-2 px-4 text-sm font-bold uppercase text-primary transition duration-300 hover:bg-secondary/80 focus:border focus:border-secondary focus:ring focus:ring-secondary/50"
		>{{ content }}</Link
	>
</template>

<script setup>
const props = defineProps({
	url: {
		type: String,
		default: route("home"),
	},
	content: {
		type: String,
		default: "Sign",
	},
});
</script>
