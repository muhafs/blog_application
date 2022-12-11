<template>
	<button
		class="flex items-center gap-x-2 rounded-full bg-primary py-2 px-4 text-xs uppercase text-secondary duration-300 hover:bg-white hover:text-blue-500"
	>
		<span>
			<svg
				xmlns="http://www.w3.org/2000/svg"
				viewBox="0 0 24 24"
				fill="none"
				stroke="currentColor"
				stroke-width="2"
				stroke-linecap="round"
				stroke-linejoin="round"
				class="feather feather-plus-circle inline h-4 w-4"
			>
				<circle cx="12" cy="12" r="10"></circle>
				<line x1="12" y1="8" x2="12" y2="16"></line>
				<line x1="8" y1="12" x2="16" y2="12"></line>
			</svg>
		</span>
		<span> new {{ content }} </span>
	</button>
</template>

<script setup>
const props = defineProps({
	content: {
		type: String,
		default: "item",
	},
});
</script>
