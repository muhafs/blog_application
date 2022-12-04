<template>
	<Head title="Create Post" />

	<div class="mx-auto w-10/12 overflow-hidden rounded-xl bg-white shadow-2xl">
		<header class="mb-4 bg-primary px-6 py-4 text-secondary">
			<span class="font-bold uppercase tracking-wide">Create Post</span>
		</header>

		<form
			@submit.prevent="
				form.put(route('dashboard.posts.update', post.slug))
			"
			class="px-6"
		>
			<div class="mb-4">
				<label
					for="title"
					class="ml-2 mb-1 block font-bold uppercase tracking-wide text-primary"
					>title</label
				>
				<input
					id="title"
					type="text"
					class="block w-full rounded-3xl border border-primary/30 bg-ghost px-4 py-2 text-gray-900 placeholder:text-sm placeholder:text-primary/80 focus:border-primary focus:ring-primary sm:text-base"
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
					class="block w-full rounded-3xl border border-primary/30 bg-ghost px-4 py-2 text-gray-900 placeholder:text-sm placeholder:text-primary/80 focus:border-primary focus:ring-primary sm:text-base"
					placeholder="Content..."
					v-model="form.content"
				></textarea>

				<p v-if="errors.content" class="ml-4 mt-1 text-sm text-red-600">
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

				<div class="mb-4">
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
				</div>
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
import { ref } from "vue";
import axios from "axios";

// Import FilePond
import vueFilePond from "vue-filepond";
// Import plugins
import FilePondPluginFilePoster from "filepond-plugin-file-poster";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginImagePreview from "filepond-plugin-image-preview";
// Import styles
import "filepond/dist/filepond.min.css";
import "filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css";
import "filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css";
// Create FilePond component
const FilePond = vueFilePond(
	FilePondPluginFileValidateType,
	FilePondPluginImagePreview,
	FilePondPluginFilePoster
);

const props = defineProps(["post", "errors", "categories"]);

const form = useForm({
	title: props.post.title,
	content: props.post.content,
	category_id: props.post.category_id,
	image: props.post.image,
});

const myFiles = ref([]);
function handleFilePondInit() {
	if (form.image) {
		myFiles.value = [
			{
				source: "/storage/" + form.image,
				options: {
					type: "local",
					metadata: {
						poster: "/storage/" + form.image,
					},
				},
			},
		];
	} else {
		myFiles.value = [];
	}
}
function handleFilePondLoad(response) {
	form.image = response;
}
function handleFilePondRemove(source, load, error) {
	form.image = "/uploads/posts/default.png";
	load();
}
function handleFilePondRevert(uniqueID, load, error) {
	axios.post("/upload-post-revert", {
		image: form.image,
	});

	load();
}
</script>
