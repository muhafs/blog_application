<script setup>
defineProps({
	content: {
		type: String,
		default: "read more »",
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
		class="inline-block rounded-full bg-primary px-4 py-2 text-sm text-secondary"
	>
		{{ content }}
	</Link>
</template>
