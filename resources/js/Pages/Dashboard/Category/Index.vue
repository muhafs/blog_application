<template>
	<Head title="Dashboard Category" />

	<div class="mb-4 flex items-center justify-between">
		<HeaderTitle content="my categories" />

		<FlashMessage />

		<CreateButton @click="openModal()" content="category" />
	</div>

	<div class="relative overflow-x-auto rounded-2xl shadow-xl">
		<table class="w-full text-center text-sm font-medium text-primary">
			<thead
				class="bg-primary text-xs font-bold uppercase text-secondary"
			>
				<TableHead :heads="['Image', 'Name', 'Created at']" />
			</thead>

			<tbody>
				<template v-if="categories.length">
					<tr
						v-for="(category, i) in categories"
						:key="category.id"
						class="border-b bg-white transition last:border-none hover:bg-ghost"
					>
						<th class="py-4 px-6">{{ ++i }}</th>

						<TableBody :content="category" />

						<td class="py-4 px-6">
							<div
								class="flex items-center justify-center gap-x-1"
							>
								<EditButton @click="openModal(category)" />

								<DeleteButton
									@click="deleteCategory(category.id)"
								/>
							</div>
						</td>
					</tr>
				</template>

				<!--! No Categories -->
				<template v-else>
					<TableEmpty
						:cols="5"
						content="User has no categories yet"
					/>
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
					type="button"
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
import FlashMessage from "@/Components/Dashboard/FlashMessage.vue";
import ModalBox from "@/Components/ModalBox.vue";
import CreateButton from "@/Components/Dashboard/CreateButton.vue";
import HeaderTitle from "@/Components/Dashboard/HeaderTitle.vue";
import TableHead from "@/Components/Dashboard/TableHead.vue";
import EditButton from "@/Components/Dashboard/EditButton.vue";
import DeleteButton from "@/Components/Dashboard/DeleteButton.vue";

import { Inertia } from "@inertiajs/inertia";
import { useForm, usePage } from "@inertiajs/inertia-vue3";
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
import TableBody from "@/Components/Dashboard/TableBody.vue";
import TableEmpty from "@/Components/Dashboard/TableEmpty.vue";
// Create FilePond component
const FilePond = vueFilePond(
	FilePondPluginFileValidateType,
	FilePondPluginImagePreview,
	FilePondPluginFilePoster
);
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
