<template>
	<Head title="Dashboard Posts" />

	<div class="mb-4 flex items-center justify-between">
		<h2 class="pl-4 text-2xl font-bold uppercase text-primary">My Posts</h2>

		<div
			v-if="$page.props.flash.message"
			class="rounded-full bg-secondary px-4 py-1 text-center text-primary"
		>
			{{ $page.props.flash.message }}
		</div>

		<button
			class="flex items-center gap-x-2 rounded-full bg-primary py-2 px-4 text-xs uppercase text-secondary duration-300 hover:bg-white hover:text-blue-500"
			@click="openModal()"
		>
			<span>
				<svg
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="2"
					stroke-linecap="round"
					stroke-linejoin="round"
					class="feather feather-plus-circle inline h-4 w-4"
				>
					<circle cx="12" cy="12" r="10"></circle>
					<line x1="12" y1="8" x2="12" y2="16"></line>
					<line x1="8" y1="12" x2="16" y2="12"></line>
				</svg>
			</span>
			<span> new post </span>
		</button>
		<!-- <Link
			class="flex items-center gap-x-2 rounded-full bg-primary py-2 px-4 text-xs uppercase text-secondary duration-300 hover:bg-white hover:text-blue-500"
			:href="route('dashboard.posts.create')"
		>
			<span>
				<svg
					xmlns="http://www.w3.org/2000/svg"
					viewBox="0 0 24 24"
					fill="none"
					stroke="currentColor"
					stroke-width="2"
					stroke-linecap="round"
					stroke-linejoin="round"
					class="feather feather-plus-circle inline h-4 w-4"
				>
					<circle cx="12" cy="12" r="10"></circle>
					<line x1="12" y1="8" x2="12" y2="16"></line>
					<line x1="8" y1="12" x2="16" y2="12"></line>
				</svg>
			</span>
			<span> new post </span>
		</Link> -->
	</div>

	<div class="relative overflow-x-auto rounded-2xl shadow-xl">
		<table class="w-full text-left text-sm font-medium text-primary">
			<thead
				class="bg-primary text-xs font-bold uppercase text-secondary"
			>
				<tr>
					<th class="py-3 px-6">#</th>
					<th class="py-3 px-6">Image</th>
					<th class="py-3 px-6">Title</th>
					<th class="py-3 px-6">Category</th>
					<th class="py-3 px-6">Created at</th>
					<th class="py-3 px-6 text-center">Action</th>
				</tr>
			</thead>

			<tbody>
				<template v-if="posts.data.length">
					<tr
						v-for="(post, i) in posts.data"
						:key="post.id"
						class="border-b bg-white transition last:border-none hover:bg-ghost"
					>
						<th class="py-4 px-6">{{ ++i }}</th>
						<th class="py-4 px-6">
							<img
								:src="'/storage/' + post.image"
								:alt="post.title"
								class="h-16 w-full rounded-xl object-cover"
							/>
						</th>
						<td class="whitespace-nowrap py-4 px-6">
							{{ post.title }}
						</td>
						<td class="py-4 px-6">{{ post.category }}</td>
						<td class="py-4 px-6">
							{{ formatDate(post.created_at) }}
						</td>
						<td
							class="flex h-full items-center justify-center gap-x-1 py-4 px-6"
						>
							<Link
								:href="route('dashboard.posts.show', post.slug)"
								class="rounded-full bg-primary p-1.5 text-secondary transition hover:bg-white hover:text-orange-500"
							>
								<svg
									xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24"
									fill="none"
									stroke="currentColor"
									stroke-width="2"
									stroke-linecap="round"
									stroke-linejoin="round"
									class="feather feather-eye h-4 w-4"
								>
									<path
										d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"
									></path>
									<circle cx="12" cy="12" r="3"></circle>
								</svg>
							</Link>

							<button
								:href="route('dashboard.posts.edit', post.slug)"
								@click="openModal(true, post.slug)"
								class="rounded-full bg-primary p-1.5 text-secondary transition hover:bg-white hover:text-teal-500"
							>
								<svg
									xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24"
									fill="none"
									stroke="currentColor"
									stroke-width="2"
									stroke-linecap="round"
									stroke-linejoin="round"
									class="feather feather-edit-2 h-4 w-4"
								>
									<path
										d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
									></path>
								</svg>
							</button>

							<!-- <Link
								:href="route('dashboard.posts.edit', post.slug)"
								class="rounded-full bg-primary p-1.5 text-secondary transition hover:bg-white hover:text-teal-500"
							>
								<svg
									xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24"
									fill="none"
									stroke="currentColor"
									stroke-width="2"
									stroke-linecap="round"
									stroke-linejoin="round"
									class="feather feather-edit-2 h-4 w-4"
								>
									<path
										d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"
									></path>
								</svg>
							</Link> -->

							<button
								@click="deletePost(post.slug)"
								class="rounded-full bg-primary p-1.5 text-secondary transition hover:bg-white hover:text-red-500"
							>
								<svg
									xmlns="http://www.w3.org/2000/svg"
									viewBox="0 0 24 24"
									fill="none"
									stroke="currentColor"
									stroke-width="2"
									stroke-linecap="round"
									stroke-linejoin="round"
									class="feather feather-trash-2 h-4 w-4"
								>
									<polyline points="3 6 5 6 21 6"></polyline>
									<path
										d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
									></path>
									<line
										x1="10"
										y1="11"
										x2="10"
										y2="17"
									></line>
									<line
										x1="14"
										y1="11"
										x2="14"
										y2="17"
									></line>
								</svg>
							</button>
						</td>
					</tr>
				</template>

				<!--! No Posts -->
				<template v-else>
					<tr
						class="border-b bg-white transition last:border-none hover:bg-ghost"
					>
						<th colspan="6" class="py-4 px-6 text-center">
							User hasn't created any posts yet
						</th>
					</tr>
				</template>
			</tbody>
		</table>
	</div>

	<ModalBox :is-open="isModalOpen" @close-modal="isModalOpen = false">
		<header
			class="w-full bg-primary px-8 py-4 text-center text-xl font-bold uppercase text-secondary"
		>
			{{ isEditable ? "Edit" : "Create New" }} Post
		</header>

		<form @submit.prevent="submit" enctype="multipart/form-data">
			<main class="px-8 py-4">
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
							errors.title
								? 'border-red-600'
								: 'border-primary/30',
						]"
						placeholder="john.doe@company.com"
						required
						v-model="form.title"
					/>

					<p
						v-if="errors.title"
						class="ml-4 mt-1 text-sm text-red-600"
					>
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
							errors.content
								? 'border-red-600'
								: 'border-primary/30',
						]"
						placeholder="Content..."
						v-model="form.content"
					></textarea>

					<p
						v-if="errors.content"
						class="ml-4 mt-1 text-sm text-red-600"
					>
						{{ errors.content }}
					</p>
				</div>

				<div class="grid grid-cols-2 gap-4">
					<div class="mb-4">
						<label
							for="categories"
							class="ml-2 mb-1 block font-bold uppercase tracking-wide text-primary"
							>category</label
						>

						<select
							id="categories"
							v-model="form.category"
							:class="[
								'block w-full rounded-3xl border  bg-ghost px-4 py-2 text-gray-900 placeholder:text-sm placeholder:text-primary/80 focus:border-primary focus:ring-primary sm:text-base',
								errors.category
									? 'border-red-600'
									: 'border-primary/30',
							]"
						>
							<option selected class="hidden" value="0">
								-- Choose a category --
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
							v-if="errors.category"
							class="ml-4 mt-1 text-sm text-red-600"
						>
							{{ errors.category_id }}
						</p>
					</div>

					<!-- <div class="mb-4">
						<label
							class="ml-2 mb-1 block font-bold uppercase tracking-wide text-primary"
							>Image</label
						>

						<FilePond
							name="image"
							ref="pond"
							:allow-multiple="false"
							accepted-file-types="image/png, image/jpg, image/jpeg"
							:server="{
								url: '',
								timeout: 7000,
								process: {
									url: '/upload-post-img',
									method: 'POST',
									headers: {
										'X-CSRF-TOKEN': $page.props.csrf_token,
									},
									withCredentials: false,
									onload: handleFilePondLoad,
									onerror: (response) => response.data,
								},
								remove: handleFilePondRemove,
								revert: handleFilePondRevert,
							}"
							:files="myFiles"
							@init="handleFilePondInit"
						/>

						<p
							v-if="errors.image"
							class="ml-4 mt-1 text-sm text-red-600"
						>
							{{ errors.image }}
						</p>
					</div> -->
				</div>
			</main>

			<footer
				class="flex justify-between border-t border-primary/20 px-8 py-4"
			>
				<button
					@click="isModalOpen = false"
					class="rounded-full bg-secondary py-2 px-4 font-bold uppercase text-primary"
				>
					Cancele
				</button>

				<button
					type="submit"
					class="rounded-full bg-primary py-2 px-4 font-bold uppercase text-secondary"
				>
					{{ isEditable ? "Save" : "Create" }}
				</button>
			</footer>
		</form>
	</ModalBox>
</template>

<script setup>
import ModalBox from "@/Components/ModalBox.vue";
import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import axios from "axios";

import moment from "moment";
import { ref } from "vue";

// Properties
const props = defineProps(["posts", "errors", "categories"]);

const isModalOpen = ref(false);
const isEditable = ref(false);
const form = useForm({
	title: "",
	content: "",
	category: 0,
	image: "",
});

// Methods
function formatDate(date) {
	return moment(date).format("MMM D YYYY - h:mm a");
}
function openModal(isEdit = false, slug = null) {
	isModalOpen.value = true;
	isEditable.value = isEdit;

	if (isEdit) {
		const post = getPostBySlug(slug);
		// formData = post;
	} else {
	}
}
function getPostBySlug(slug) {
	//
	return {};
}
function deletePost(slug) {
	if (confirm("are you sure ?")) {
		Inertia.delete(route("dashboard.posts.destroy", slug));
	}
}
</script>
