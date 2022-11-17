<script setup>
defineProps({
	content: {
		type: String,
		default: "Read more »",
	},
	url: {
		type: String,
		default: route("home"),
	},
});
</script>

<template>
	<Link
		:href="url"
		class="inline-block rounded-md bg-primary px-3 py-2 text-sm text-white"
	>
		{{ content }}
	</Link>
</template>
