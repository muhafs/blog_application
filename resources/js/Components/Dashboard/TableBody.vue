<template>
	<td class="py-4 px-6">
		<img
			:src="'/storage/' + content.image"
			:alt="content.name"
			class="h-16 w-full rounded-xl object-cover"
		/>
	</td>

	<td class="whitespace-nowrap py-4 px-6">
		{{ content.name }}
	</td>

	<td class="py-4 px-6">
		{{ formatDate(content.created_at) }}
	</td>
</template>

<script setup>
import moment from "moment";

const props = defineProps({
	content: {
		type: Object,
	},
});

function formatDate(date) {
	return moment(date).format("MMM D YYYY - h:mm a");
}
</script>
