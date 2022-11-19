<script setup>
import { Link } from "@inertiajs/inertia-vue3";
</script>

<template>
	<Link
		class="block w-full bg-primary px-4 py-2 text-left text-sm leading-5 text-secondary transition duration-150 ease-in-out hover:bg-primary/50 focus:bg-primary/80 focus:outline-none"
	>
		<slot />
	</Link>
</template>
