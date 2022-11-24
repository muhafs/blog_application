<template>
	<Head title="Muhamad Blog - About" />

	About
	<span
		class="cursor-pointer rounded-full bg-primary px-4 py-2 font-bold text-secondary"
	>
		{{ user.name }}
	</span>
</template>

<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const user = computed(() => usePage().props.value.auth.user);
</script>
