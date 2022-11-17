<template>
	<h1
		class="mb-4 border-b-2 border-slate-300 pb-3 text-center text-3xl font-bold"
	>
		{{ content }}
	</h1>
</template>

<script setup>
const props = defineProps({
	content: {
		type: String,
		default: "Title",
	},
});
</script>
