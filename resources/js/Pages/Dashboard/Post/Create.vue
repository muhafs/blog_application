<template>
	<Head title="Create Post" />

	<div class="mx-auto w-10/12 overflow-hidden rounded-xl bg-white shadow-2xl">
		<header class="mb-4 bg-primary px-6 py-4 text-secondary">
			<span class="font-bold uppercase tracking-wide">Create Post</span>
		</header>

		<form @submit.prevent="submit()" class="px-6">
			<div class="mb-4">
				<label
					for="title"
					class="ml-2 mb-1 block font-bold uppercase tracking-wide text-primary"
					>title</label
				>

				<input
					id="title"
					type="text"
					:class="[
						'block w-full rounded-3xl border  bg-ghost px-4 py-2 text-gray-900 placeholder:text-sm placeholder:text-primary/80 focus:border-primary focus:ring-primary sm:text-base',
						errors.title ? 'border-red-600' : 'border-primary/30',
					]"
					placeholder="john.doe@company.com"
					required
					v-model="form.title"
				/>

				<p v-if="errors.title" class="ml-4 mt-1 text-sm text-red-600">
					{{ errors.title }}
				</p>
			</div>

			<div class="mb-4">
				<label
					for="content"
					class="ml-2 mb-1 block font-bold uppercase tracking-wide text-primary"
					>content</label
				>

				<textarea
					id="content"
					rows="4"
					:class="[
						'block w-full rounded-3xl border  bg-ghost px-4 py-2 text-gray-900 placeholder:text-sm placeholder:text-primary/80 focus:border-primary focus:ring-primary sm:text-base',
						errors.content ? 'border-red-600' : 'border-primary/30',
					]"
					placeholder="Content..."
					v-model="form.content"
				></textarea>

				<p v-if="errors.content" class="ml-4 mt-1 text-sm text-red-600">
					{{ errors.content }}
				</p>
			</div>

			<div class="mb-4">
				<label
					for="categories"
					class="ml-2 mb-1 block font-bold uppercase tracking-wide text-primary"
					>category</label
				>

				<select
					id="categories"
					v-model="form.category_id"
					:class="[
						'block w-full rounded-3xl border  bg-ghost px-4 py-2 text-gray-900 placeholder:text-sm placeholder:text-primary/80 focus:border-primary focus:ring-primary sm:text-base',
						errors.category_id
							? 'border-red-600'
							: 'border-primary/30',
					]"
				>
					<option selected class="hidden" value="0">
						Choose a category
					</option>
					<option
						v-for="category in categories"
						:key="category.id"
						:value="category.id"
					>
						{{ category.name }}
					</option>
				</select>

				<p
					v-if="errors.category_id"
					class="ml-4 mt-1 text-sm text-red-600"
				>
					{{ errors.category_id }}
				</p>
			</div>

			<hr class="mt-8 block border border-primary/20" />

			<div class="flex items-center justify-between py-4">
				<Link
					:href="route('dashboard.posts.index')"
					class="rounded-full bg-secondary py-2 px-4 font-bold uppercase text-primary"
				>
					Cancele
				</Link>

				<button
					type="submit"
					class="rounded-full bg-primary py-2 px-4 font-bold uppercase text-secondary"
				>
					Submit
				</button>
			</div>
		</form>
	</div>
</template>

<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps(["errors", "categories"]);

const form = useForm({
	title: "",
	content: "",
	category_id: 0,
});

function submit() {
	form.post("/dashboard/posts", form);
}
</script>
