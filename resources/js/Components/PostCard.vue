<template>
	<article class="overflow-hidden rounded-lg bg-white shadow-lg">
		<div class="relative">
			<img
				src="https://via.placeholder.com/500x400"
				class="h-64 w-full object-cover"
			/>

			<Link
				:href="route('category-detail', post.category.slug)"
				class="absolute top-0 left-0 rounded-sm bg-slate-800/70 p-2 text-white"
				>{{ post.category.name }}</Link
			>
		</div>

		<div class="p-5">
			<h2 class="mb-2 text-lg font-bold">
				{{ post.title }}
			</h2>

			<h3 class="mb-3 text-sm font-medium text-slate-500">
				<span>
					By :
					<Link href="#" class="text-primary">{{
						post.user.name
					}}</Link>

					{{ moment(post.created_at).fromNow() }}
				</span>
			</h3>

			<p class="mb-4 text-base">
				{{ `${post.content.slice(0, 50)}...` }}
			</p>

			<PrimaryButton :url="route('blog-detail', post.slug)" />
		</div>
	</article>
</template>

<script setup>
import moment from "moment";
import PrimaryButton from "./PrimaryButton.vue";

const props = defineProps(["post"]);
// img
// category link
// category tag
// title
// author
// created date
// detail link
</script>
