<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";

import { Head, Link } from "@inertiajs/inertia-vue3";
import { ref, watch } from "vue";
import { Inertia } from "@inertiajs/inertia";

import moment from "moment";

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
	<Head title="Muhamad Blog - Blog" />

	<GuestLayout>
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

		<template v-if="posts.data.length">
			<div
				class="mb-3 w-full overflow-hidden rounded-md border border-slate-200 bg-white shadow-lg"
			>
				<img
					src="https://via.placeholder.com/1200x500"
					class="h-64 w-full object-cover"
				/>

				<div class="p-5 text-center">
					<h2 class="mb-2 text-2xl font-bold">
						{{ props.posts.data[0].title }}
					</h2>

					<h3 class="mb-3 text-sm font-semibold text-slate-500">
						<span>
							By :
							<Link href="#" class="text-primary">{{
								props.posts.data[0].user.name
							}}</Link>

							{{
								moment(props.posts.data[0].created_at).fromNow()
							}}
						</span>
						<span class="mt-1 block">
							category :
							<Link
								:href="
									route(
										'category-detail',
										props.posts.data[0].category.slug
									)
								"
								class="text-primary"
							>
								{{ props.posts.data[0].category.name }}
							</Link>
						</span>
					</h3>

					<p class="mb-4 text-base">
						{{ `${props.posts.data[0].content.slice(0, 100)}...` }}
					</p>
					<button>
						<Link
							:href="
								route('blog-detail', props.posts.data[0].slug)
							"
							class="inline-block rounded-md bg-primary px-4 py-2 text-white"
						>
							Read more »
						</Link>
					</button>
				</div>
			</div>

			<div class="mb-8 grid grid-cols-3 gap-4">
				<article
					v-for="post in props.posts.data.slice(1)"
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

		<nav>
			<ul class="flex justify-center -space-x-px">
				<li v-for="(link, index) in posts.links" :key="index">
					<span
						v-if="link.url == null"
						:class="[
							'border border-gray-300 bg-white py-2 px-3 text-gray-400',
							{
								'rounded-l-lg ': index == 0,
								'rounded-r-lg': index == posts.links.length - 1,
							},
						]"
						v-html="link.label"
					></span>
					<Link
						v-else
						:href="link.url"
						:class="[
							'border border-gray-300 bg-white py-2 px-3 text-gray-900',
							{
								'text-primary': link.active,
								'rounded-l-lg ': index == 0,
								'rounded-r-lg': index == posts.links.length - 1,
							},
						]"
						v-html="link.label"
					/>
				</li>
			</ul>
		</nav>
	</GuestLayout>
</template>
