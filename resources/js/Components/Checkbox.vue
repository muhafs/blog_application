<script setup>
import { computed } from "vue";

const emit = defineEmits(["update:checked"]);

const props = defineProps({
	checked: {
		type: [Array, Boolean],
		default: false,
	},
	value: {
		default: null,
	},
});

const proxyChecked = computed({
	get() {
		return props.checked;
	},

	set(val) {
		emit("update:checked", val);
	},
});
</script>

<template>
	<input
		type="checkbox"
		:value="value"
		v-model="proxyChecked"
		class="rounded-full border-primary/70 text-primary shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-50"
	/>
</template>
