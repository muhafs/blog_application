<template>
	<Head title="Dashboard" />

	<div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
		<div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
			<div class="border-b border-gray-200 bg-white p-6">
				hello {{ user.name }}
				<br />
				You're logged in! this page from folder Dashboard
			</div>
		</div>
	</div>
</template>

<script setup>
import { computed } from "vue";
import { usePage } from "@inertiajs/inertia-vue3";

const user = computed(() => usePage().props.value.auth.user);
</script>
