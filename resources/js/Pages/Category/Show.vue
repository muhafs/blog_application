<script setup>
import CategoryHeader from "@/Components/CategoryHeader.vue";
import SearchBar from "@/Components/SearchBar.vue";
import NotFound from "@/Components/NotFound.vue";
import PostCard from "@/Components/PostCard.vue";
import { ref, watch } from "vue";

import { Inertia } from "@inertiajs/inertia";
import { debounce } from "lodash";
import moment from "moment";

const props = defineProps(["category"]);

const search = ref(props.category.filter);
watch(
	search,
	debounce((value) => {
		Inertia.get(
			`/category/${props.category.slug}`,
			{ search: value },
			{ preserveState: true, replace: true }
		);
	}, 300)
);
</script>

<template>
	<!-- Browser Title -->
	<Head title="Muhamad Blog - Category" />

	<!-- Header -->
	<CategoryHeader :content="category.name" />

	<!-- Search Bar -->
	<SearchBar v-model="search" />

	<!-- Main -->
	<template v-if="category.posts.length">
		<div class="grid grid-cols-3 gap-4">
			<PostCard
				v-for="(post, index) in category.posts"
				:key="index"
				:post="post"
			/>
		</div>
	</template>

	<!-- Not Found -->
	<template v-else>
		<NotFound content="Posts" />
	</template>
</template>
