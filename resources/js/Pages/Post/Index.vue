<script setup>
import SearchBar from "@/Components/SearchBar.vue";
import PostHeroCard from "@/Components/PostHeroCard.vue";
import PostCard from "@/Components/PostCard.vue";
import NotFound from "@/Components/NotFound.vue";
import PaginationBar from "@/Components/PaginationBar.vue";

import { Inertia } from "@inertiajs/inertia";
import { ref, watch } from "vue";

const props = defineProps(["posts", "filters"]);

const search = ref(props.filters.search ?? "");
watch(search, (value) => {
	Inertia.get(
		"/blog",
		{ search: value },
		{
			preserveState: true,
			replace: true,
		}
	);
});
</script>

<template>
	<!-- Browser Title -->
	<Head title="Muhamad Blog - Blog" />

	<!-- Search Bar -->
	<SearchBar v-model="search" />

	<!-- Main -->
	<template v-if="posts.data.length">
		<PostHeroCard :post="props.posts.data[0]" />

		<div class="mb-8 grid grid-cols-3 gap-4">
			<PostCard
				v-for="(post, index) in props.posts.data.slice(1)"
				:key="index"
				:post="post"
			/>
		</div>
	</template>

	<!-- Not Found -->
	<template v-else>
		<NotFound content="Posts" />
	</template>

	<!-- Pagination -->
	<PaginationBar :links="posts.links" />
</template>
