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
	<textarea
		class="h-64 resize-none rounded-2xl border border-gray-300 px-6 py-4 text-primary shadow-sm transition duration-300 focus:border-primary"
		:value="modelValue"
		@input="$emit('update:modelValue', $event.target.value)"
		ref="input"
	></textarea>
</template>
