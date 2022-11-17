<template>
	<Link
		:href="route('category-detail', category.slug)"
		class="relative h-32 overflow-hidden rounded-lg shadow-lg"
	>
		<img
			src="https://via.placeholder.com/700x500"
			alt=""
			class="object-cover"
		/>

		<h2
			class="absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2 bg-slate-900/80 py-4 text-center font-bold text-white"
		>
			{{ category.name }}
		</h2>
	</Link>
</template>

<script setup>
const props = defineProps(["category"]);
// category img
// category name
// category slug
</script>
