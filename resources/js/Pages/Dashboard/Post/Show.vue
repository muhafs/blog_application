<template>
	<Head title="Post" />

	<article
		class="mx-auto w-10/12 overflow-hidden rounded-xl bg-white shadow-xl"
	>
		<header class="relative mb-4 bg-primary py-4 px-6 text-center">
			<Link
				:href="route('dashboard.posts.index')"
				class="absolute top-1/2 left-5 grid -translate-y-1/2 place-items-center rounded-full bg-secondary px-3 py-1"
			>
				back
			</Link>

			<span class="text-secondary">{{ post.title }}</span>
		</header>

		<main class="px-6 py-4">
			<div class="relative overflow-hidden rounded-3xl">
				<img
					:src="'/storage/' + post.image"
					:alt="post.title"
					class="h-[300px] w-full rounded-sm object-cover shadow-md"
				/>

				<span
					class="absolute top-0 left-0 block rounded-br-3xl bg-primary/50 py-2 px-4 text-white"
				>
					category : {{ post.category.name }}
				</span>
			</div>

			<p class="my-4 ml-2 text-base font-light text-slate-700">
				{{ post.content }}
			</p>
		</main>
	</article>
</template>

<script setup>
const props = defineProps(["post"]);
</script>
