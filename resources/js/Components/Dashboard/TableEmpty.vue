<template>
	<tr class="border-b bg-white transition last:border-none hover:bg-ghost">
		<th :colspan="cols" class="py-4 px-6 text-center uppercase">
			{{ content }}
		</th>
	</tr>
</template>

<script setup>
const props = defineProps({
	cols: {
		type: Number,
	},
	content: {
		type: String,
		default: "No Data Found",
	},
});
</script>
