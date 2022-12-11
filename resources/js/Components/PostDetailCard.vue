<template>
	<article class="mx-auto w-8/12 rounded-3xl bg-white p-6 shadow-lg">
		<h2 class="mb-6 text-center text-3xl font-bold text-slate-900">
			{{ post.title }}
		</h2>

		<section
			class="mb-3 flex items-center justify-between text-sm font-semibold text-slate-500"
		>
			<span>
				By :
				<Link href="#" class="text-primary">{{ post.user.name }}</Link>
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
		</section>

		<div class="overflow-hidden rounded-3xl">
			<img
				:src="'/storage/' + post.image"
				class="h-64 w-full rounded-sm object-cover shadow-md"
			/>
		</div>

		<p
			class="my-4 text-base font-light text-slate-700"
			v-html="post.content"
		></p>

		<PrimaryButton :url="route('blog')" content="« back" />
	</article>
</template>

<script setup>
import PrimaryButton from "./PrimaryButton.vue";

const props = defineProps(["post"]);
</script>
