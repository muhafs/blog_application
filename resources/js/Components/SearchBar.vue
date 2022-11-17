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
	<div class="relative mx-auto mb-8 w-8/12">
		<input
			type="search"
			placeholder="Search..."
			class="block w-full rounded-lg border border-gray-300 bg-white p-4 pr-10 text-sm text-gray-900 transition duration-300 focus:border-primary focus:ring-primary"
			:value="modelValue"
			@input="$emit('update:modelValue', $event.target.value)"
			ref="input"
		/>

		<div
			class="absolute inset-y-0 right-0 flex cursor-pointer items-center pr-3"
		>
			<svg
				aria-hidden="true"
				class="h-5 w-5 text-gray-500 dark:text-gray-400"
				fill="none"
				stroke="currentColor"
				viewBox="0 0 24 24"
				xmlns="http://www.w3.org/2000/svg"
			>
				<path
					stroke-linecap="round"
					stroke-linejoin="round"
					stroke-width="2"
					d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
				></path>
			</svg>
		</div>
	</div>
</template>
