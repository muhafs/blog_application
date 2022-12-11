<template>
	<h2 class="pl-4 text-2xl font-bold uppercase text-primary">
		{{ content }}
	</h2>
</template>

<script setup>
const props = defineProps({
	content: {
		type: String,
		default: "My Items",
	},
});
</script>
