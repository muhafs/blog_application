<script setup>
import { onMounted, ref } from "vue";

defineProps(["modelValue"]);

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
	if (input.value.hasAttribute("autofocus")) {
		input.value.focus();
	}
});
</script>

<template>
	<input
		class="rounded-full border border-gray-300 px-6 text-primary shadow-sm transition duration-300 focus:border-primary"
		:value="modelValue"
		@input="$emit('update:modelValue', $event.target.value)"
		ref="input"
	/>
</template>
