<template>
	<div
		class="mb-3 w-full overflow-hidden rounded-md border border-slate-200 bg-white shadow-lg"
	>
		<img
			src="https://via.placeholder.com/1200x500"
			class="h-64 w-full object-cover"
		/>

		<div class="p-5 text-center">
			<h2 class="mb-2 text-2xl font-bold">
				{{ post.title }}
			</h2>

			<h3 class="mb-3 text-sm font-semibold text-slate-500">
				<span>
					By :
					<Link href="#" class="text-primary">{{
						post.user.name
					}}</Link>

					{{ moment(post.created_at).fromNow() }}
				</span>
				<span class="mt-1 block">
					category :
					<Link
						:href="route('category-detail', post.category.slug)"
						class="text-primary"
					>
						{{ post.category.name }}
					</Link>
				</span>
			</h3>

			<p class="mb-4 text-base">
				{{ `${post.content.slice(0, 100)}...` }}
			</p>

			<PrimaryButton :url="route('blog-detail', post.slug)" />
		</div>
	</div>
</template>

<script setup>
import PrimaryButton from "./PrimaryButton.vue";
import moment from "moment";

const props = defineProps(["post"]);
</script>
