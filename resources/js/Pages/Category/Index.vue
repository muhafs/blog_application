<script setup>
import CategoryHeader from "@/Components/CategoryHeader.vue";
import CategoryCard from "@/Components/CategoryCard.vue";
import NotFound from "@/Components/NotFound.vue";

const props = defineProps(["categories"]);
</script>

<template>
	<!-- Browser Title -->
	<Head title="Muhamad Blog - Category" />

	<!-- Header -->
	<CategoryHeader content="Post Categories" />

	<!-- Main -->
	<template v-if="categories.length">
		<div class="grid grid-cols-3 gap-4">
			<CategoryCard
				v-for="(category, index) in categories"
				:key="index"
				:category="category"
			/>
		</div>
	</template>

	<!-- Not Found -->
	<template v-else>
		<NotFound content="Categories" />
	</template>
</template>
