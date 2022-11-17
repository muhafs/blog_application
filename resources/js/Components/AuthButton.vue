<script setup>
defineProps({
	type: {
		type: String,
		default: "submit",
	},
});
</script>

<template>
	<button
		:type="type"
		class="inline-flex items-center rounded-md border border-transparent bg-primary px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-primary focus:border-primary focus:outline-none active:bg-primary"
	>
		<slot />
	</button>
</template>
