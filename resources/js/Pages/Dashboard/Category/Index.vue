<template>
	<Head title="Dashboard Category" />

	<div class="mb-4 flex items-center justify-between">
		<h2 class="pl-4 text-2xl font-bold uppercase text-primary">
			My Categories
		</h2>

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
			<span> new category </span>
		</button>
	</div>

	<div class="relative overflow-x-auto rounded-2xl shadow-xl">
		<table class="w-full text-center text-sm font-medium text-primary">
			<thead
				class="bg-primary text-xs font-bold uppercase text-secondary"
			>
				<tr>
					<th class="py-3 px-6">#</th>
					<th class="py-3 px-6">Image</th>
					<th class="py-3 px-6">Name</th>
					<th class="py-3 px-6">Created at</th>
					<th class="py-3 px-6 text-center">Action</th>
				</tr>
			</thead>

			<tbody>
				<template v-if="categories.length">
					<tr
						v-for="(category, i) in categories"
						:key="category.id"
						class="border-b bg-white transition last:border-none hover:bg-ghost"
					>
						<th class="py-4 px-6">{{ ++i }}</th>
						<th class="py-4 px-6">
							<img
								:src="'/storage/' + category.image"
								:alt="category.name"
								class="h-16 w-full rounded-xl object-cover"
							/>
						</th>
						<td class="whitespace-nowrap py-4 px-6">
							{{ category.name }}
						</td>
						<td class="py-4 px-6">
							{{ formatDate(category.created_at) }}
						</td>
						<td class="py-4 px-6">
							<div
								class="flex items-center justify-center gap-x-1"
							>
								<Link
									:href="
										route(
											'dashboard.categories.show',
											category.id
										)
									"
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
									@click="openModal(category)"
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

								<button
									@click="deleteCategory(category.id)"
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
										<polyline
											points="3 6 5 6 21 6"
										></polyline>
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
							</div>
						</td>
					</tr>
				</template>

				<!--! No Categories -->
				<template v-else>
					<tr
						class="border-b bg-white transition last:border-none hover:bg-ghost"
					>
						<th colspan="6" class="py-4 px-6 text-center">
							User has no categories yet
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
			{{ isEditable ? "Edit" : "Create New" }} Category
		</header>

		<form @submit.prevent="submitForm()" enctype="multipart/form-data">
			<main class="px-8 py-4">
				<div class="grid grid-cols-2 gap-4">
					<div class="mb-4">
						<label
							for="name"
							class="ml-2 mb-1 block font-bold uppercase tracking-wide text-primary"
							>name</label
						>

						<input
							id="name"
							type="text"
							:class="[
								'block w-full rounded-3xl border  bg-ghost px-4 py-2 text-gray-900 placeholder:text-sm placeholder:text-primary/80 focus:border-primary focus:ring-primary sm:text-base',
								errors.name
									? 'border-red-600'
									: 'border-primary/30',
							]"
							placeholder="Name..."
							v-model="form.name"
						/>

						<p
							v-if="errors.name"
							class="ml-4 mt-1 text-sm text-red-600"
						>
							{{ errors.name }}
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
									url: '/upload-category-img',
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
						/>

						<p
							v-if="errors.image"
							class="ml-4 mt-1 text-sm text-red-600"
						>
							{{ errors.image }}
						</p>
					</div>
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
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import axios from "axios";

import moment from "moment";
import { ref } from "vue";

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
const myFiles = ref([]);
function handleFilePondInit() {
	// console.log("initialize done");
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
	form.image = "/uploads/categories/default.png";
	load();
}
function handleFilePondRevert(uniqueID, load, error) {
	axios.post("/upload-category-revert", {
		image: form.image,
	});

	load();
}

// Properties
const props = defineProps(["errors", "categories"]);

const isModalOpen = ref(false);
const isEditable = ref(false);
const form = useForm({
	name: "",
	image: "",
});

// Methods
function formatDate(date) {
	return moment(date).format("MMM D YYYY - h:mm a");
}
function openModal(category = null) {
	isModalOpen.value = true;
	isEditable.value = category ? true : false;

	form.id = category ? category.id : null;
	form.name = category ? category.name : "";
	form.image = category ? category.image : "";

	if (usePage().props.value.errors) usePage().props.value.errors = {};

	handleFilePondInit();
}
function submitForm() {
	let url = "/dashboard/categories";
	if (isEditable.value) {
		url = `${url}/${form.id}`;

		form.put(url, {
			onSuccess: (page) => {
				isModalOpen.value = false;
			},
			onError: (errors) => {},
		});
	} else {
		form.post(url, {
			onSuccess: (page) => {
				isModalOpen.value = false;
			},
			onError: (errors) => {},
		});
	}
}
function deleteCategory(id) {
	if (confirm("are you sure ?")) {
		Inertia.delete(route("dashboard.categories.destroy", id));
	}
}
</script>
