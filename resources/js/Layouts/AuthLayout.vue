<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { reactive, ref } from "vue";

const isOpen = ref(false);
</script>

<template>
	<div class="flex min-h-screen w-full">
		<!-- Navigation Bar -->
		<aside
			:class="[
				'flex w-64 flex-col bg-primary text-secondary duration-300',
				isOpen ? 'w-64' : 'w-20',
			]"
		>
			<header class="relative p-4">
				<!-- Main Icon -->
				Logo

				<!-- Slider Icon -->
				<span
					:class="[
						'absolute right-0 top-1/2 grid -translate-y-1/2 translate-x-1/2 cursor-pointer place-items-center rounded-full bg-secondary text-primary duration-300',
						isOpen ? 'h-10 w-10' : 'h-6 w-6',
					]"
					@click="isOpen = !isOpen"
				>
					<svg
						xmlns="http://www.w3.org/2000/svg"
						width="24"
						height="24"
						viewBox="0 0 24 24"
						fill="none"
						stroke="currentColor"
						stroke-width="2"
						stroke-linecap="round"
						stroke-linejoin="round"
						:class="[
							'feather feather-menu duration-300',
							isOpen ? 'w-full' : 'w-4',
						]"
					>
						<line x1="3" y1="12" x2="21" y2="12"></line>
						<line x1="3" y1="6" x2="21" y2="6"></line>
						<line x1="3" y1="18" x2="21" y2="18"></line>
					</svg>
				</span>
			</header>

			<nav class="flex h-full flex-col justify-between p-4">
				<div class="">
					<Link
						class="flex items-center gap-x-4 rounded-full py-2 px-4 transition hover:bg-ghost/20"
					>
						<span>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 512 512"
								class="inline w-4 fill-current"
							>
								<path
									d="M456 32h-304C121.1 32 96 57.13 96 88v320c0 13.22-10.77 24-24 24S48 421.2 48 408V112c0-13.25-10.75-24-24-24S0 98.75 0 112v296C0 447.7 32.3 480 72 480h352c48.53 0 88-39.47 88-88v-304C512 57.13 486.9 32 456 32zM464 392c0 22.06-17.94 40-40 40H139.9C142.5 424.5 144 416.4 144 408v-320c0-4.406 3.594-8 8-8h304c4.406 0 8 3.594 8 8V392zM264 272h-64C186.8 272 176 282.8 176 296S186.8 320 200 320h64C277.3 320 288 309.3 288 296S277.3 272 264 272zM408 272h-64C330.8 272 320 282.8 320 296S330.8 320 344 320h64c13.25 0 24-10.75 24-24S421.3 272 408 272zM264 352h-64c-13.25 0-24 10.75-24 24s10.75 24 24 24h64c13.25 0 24-10.75 24-24S277.3 352 264 352zM408 352h-64C330.8 352 320 362.8 320 376s10.75 24 24 24h64c13.25 0 24-10.75 24-24S421.3 352 408 352zM400 112h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32v-64C432 126.3 417.7 112 400 112z"
								/>
							</svg>
						</span>

						<span
							:class="[
								'origin-left duration-300',
								isOpen ? '' : 'scale-0',
							]"
						>
							Dashboard
						</span>
					</Link>

					<Link
						class="flex items-center gap-x-4 rounded-full py-2 px-4 transition hover:bg-ghost/20"
					>
						<span>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 512 512"
								class="inline w-4 fill-current"
							>
								<path
									d="M456 32h-304C121.1 32 96 57.13 96 88v320c0 13.22-10.77 24-24 24S48 421.2 48 408V112c0-13.25-10.75-24-24-24S0 98.75 0 112v296C0 447.7 32.3 480 72 480h352c48.53 0 88-39.47 88-88v-304C512 57.13 486.9 32 456 32zM464 392c0 22.06-17.94 40-40 40H139.9C142.5 424.5 144 416.4 144 408v-320c0-4.406 3.594-8 8-8h304c4.406 0 8 3.594 8 8V392zM264 272h-64C186.8 272 176 282.8 176 296S186.8 320 200 320h64C277.3 320 288 309.3 288 296S277.3 272 264 272zM408 272h-64C330.8 272 320 282.8 320 296S330.8 320 344 320h64c13.25 0 24-10.75 24-24S421.3 272 408 272zM264 352h-64c-13.25 0-24 10.75-24 24s10.75 24 24 24h64c13.25 0 24-10.75 24-24S277.3 352 264 352zM408 352h-64C330.8 352 320 362.8 320 376s10.75 24 24 24h64c13.25 0 24-10.75 24-24S421.3 352 408 352zM400 112h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32v-64C432 126.3 417.7 112 400 112z"
								/>
							</svg>
						</span>

						<span
							:class="[
								'origin-left duration-300',
								isOpen ? '' : 'scale-0',
							]"
						>
							Posts
						</span>
					</Link>

					<Link
						class="flex items-center gap-x-4 rounded-full py-2 px-4 transition hover:bg-ghost/20"
					>
						<span>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 512 512"
								class="inline w-4 fill-current"
							>
								<path
									d="M456 32h-304C121.1 32 96 57.13 96 88v320c0 13.22-10.77 24-24 24S48 421.2 48 408V112c0-13.25-10.75-24-24-24S0 98.75 0 112v296C0 447.7 32.3 480 72 480h352c48.53 0 88-39.47 88-88v-304C512 57.13 486.9 32 456 32zM464 392c0 22.06-17.94 40-40 40H139.9C142.5 424.5 144 416.4 144 408v-320c0-4.406 3.594-8 8-8h304c4.406 0 8 3.594 8 8V392zM264 272h-64C186.8 272 176 282.8 176 296S186.8 320 200 320h64C277.3 320 288 309.3 288 296S277.3 272 264 272zM408 272h-64C330.8 272 320 282.8 320 296S330.8 320 344 320h64c13.25 0 24-10.75 24-24S421.3 272 408 272zM264 352h-64c-13.25 0-24 10.75-24 24s10.75 24 24 24h64c13.25 0 24-10.75 24-24S277.3 352 264 352zM408 352h-64C330.8 352 320 362.8 320 376s10.75 24 24 24h64c13.25 0 24-10.75 24-24S421.3 352 408 352zM400 112h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32v-64C432 126.3 417.7 112 400 112z"
								/>
							</svg>
						</span>

						<span
							:class="[
								'origin-left duration-300',
								isOpen ? '' : 'scale-0',
							]"
						>
							Categories
						</span>
					</Link>
				</div>

				<div class="">
					<Link
						class="flex gap-x-4 rounded-full py-2 px-4 transition hover:bg-ghost/20"
					>
						<span>
							<svg
								xmlns="http://www.w3.org/2000/svg"
								viewBox="0 0 512 512"
								class="inline w-4 fill-current"
							>
								<path
									d="M456 32h-304C121.1 32 96 57.13 96 88v320c0 13.22-10.77 24-24 24S48 421.2 48 408V112c0-13.25-10.75-24-24-24S0 98.75 0 112v296C0 447.7 32.3 480 72 480h352c48.53 0 88-39.47 88-88v-304C512 57.13 486.9 32 456 32zM464 392c0 22.06-17.94 40-40 40H139.9C142.5 424.5 144 416.4 144 408v-320c0-4.406 3.594-8 8-8h304c4.406 0 8 3.594 8 8V392zM264 272h-64C186.8 272 176 282.8 176 296S186.8 320 200 320h64C277.3 320 288 309.3 288 296S277.3 272 264 272zM408 272h-64C330.8 272 320 282.8 320 296S330.8 320 344 320h64c13.25 0 24-10.75 24-24S421.3 272 408 272zM264 352h-64c-13.25 0-24 10.75-24 24s10.75 24 24 24h64c13.25 0 24-10.75 24-24S277.3 352 264 352zM408 352h-64C330.8 352 320 362.8 320 376s10.75 24 24 24h64c13.25 0 24-10.75 24-24S421.3 352 408 352zM400 112h-192c-17.67 0-32 14.33-32 32v64c0 17.67 14.33 32 32 32h192c17.67 0 32-14.33 32-32v-64C432 126.3 417.7 112 400 112z"
								/>
							</svg>
						</span>

						<span
							:class="[
								'origin-left duration-300',
								isOpen ? '' : 'scale-0',
							]"
						>
							Log out
						</span>
					</Link>
				</div>
			</nav>
		</aside>

		<!-- Page Content -->
		<main class="w-full bg-ghost">
			<header class="bg-white px-8 py-4 font-bold shadow-md">
				<slot name="header">Header</slot>
			</header>

			<main class="w-full p-8">
				<slot>content</slot>
			</main>
		</main>
	</div>
</template>
