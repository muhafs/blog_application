<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps(["categories"]);
</script>

<template>
	<Head title="Muhamad Blog - Category" />

	<GuestLayout>
		<h1
			class="mb-4 border-b-2 border-slate-300 pb-3 text-center text-3xl font-bold"
		>
			Post Categories
		</h1>

		<template v-if="categories.length">
			<div class="grid grid-cols-3 gap-4">
				<Link
					v-for="category in categories"
					:key="category.id"
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
			</div>
		</template>

		<template v-else>
			<div class="relative w-full py-32">
				<div
					class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
				>
					<p class="text-3xl font-bold">No Categories Found</p>
				</div>
			</div>
		</template>
	</GuestLayout>
</template>
