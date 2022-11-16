<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Head, Link } from "@inertiajs/inertia-vue3";
import moment from "moment";
import { ref, watch } from "vue";

const props = defineProps(["category"]);

const search = ref(props.category.filter);
watch(search, (value) => {
	Inertia.get(
		`/category/${props.category.slug}`,
		{ search: value },
		{ preserveState: true, replace: true }
	);
});
</script>

<template>
	<Head title="Muhamad Blog - Category" />

	<GuestLayout>
		<h1
			class="mb-4 border-b-2 border-slate-300 pb-3 text-center text-3xl font-bold"
		>
			{{ category.name }}
		</h1>

		<div class="relative mx-auto mb-8 w-8/12">
			<input
				type="search"
				class="block w-full rounded-lg border border-gray-300 bg-white p-4 pr-10 text-sm text-gray-900 transition duration-300 focus:border-primary focus:ring-primary"
				placeholder="Search..."
				v-model="search"
			/>

			<div
				class="absolute inset-y-0 right-0 flex cursor-pointer items-center pr-3"
			>
				<svg
					aria-hidden="true"
					class="h-5 w-5 text-gray-500 dark:text-gray-400"
					fill="none"
					stroke="currentColor"
					viewBox="0 0 24 24"
					xmlns="http://www.w3.org/2000/svg"
				>
					<path
						stroke-linecap="round"
						stroke-linejoin="round"
						stroke-width="2"
						d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"
					></path>
				</svg>
			</div>
		</div>

		<template v-if="category.posts.length">
			<div class="grid grid-cols-3 gap-4">
				<article
					v-for="post in category.posts"
					:key="post.id"
					class="overflow-hidden rounded-lg bg-white shadow-lg"
				>
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
						<button>
							<Link
								:href="route('blog-detail', post.slug)"
								class="inline-block rounded-md bg-primary px-2 py-1 text-sm text-white"
							>
								Read more »
							</Link>
						</button>
					</div>
				</article>
			</div>
		</template>

		<template v-else>
			<div class="relative w-full py-32">
				<div
					class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
				>
					<p class="text-3xl font-bold">No Posts Found</p>
				</div>
			</div>
		</template>
	</GuestLayout>
</template>
