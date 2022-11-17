<template>
	<div class="relative w-full py-32">
		<div
			class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
		>
			<p class="text-3xl font-bold">No {{ content }} Found</p>
		</div>
	</div>
</template>

<script setup>
const props = defineProps({
	content: {
		type: String,
		default: "Data",
	},
});
</script>
