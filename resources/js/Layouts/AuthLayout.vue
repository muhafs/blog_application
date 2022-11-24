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
						:href="route('dashboard')"
						class="flex items-center justify-start gap-x-4 rounded-full py-2 px-4 transition hover:bg-ghost/20"
					>
						<span>
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
								class="feather feather-monitor inline h-4 w-4"
							>
								<rect
									x="2"
									y="3"
									width="20"
									height="14"
									rx="2"
									ry="2"
								></rect>
								<line x1="8" y1="21" x2="16" y2="21"></line>
								<line x1="12" y1="17" x2="12" y2="21"></line>
							</svg>
						</span>

						<span
							:class="[
								'origin-left duration-300',
								isOpen ? '' : 'hidden ',
							]"
						>
							Dashboard
						</span>
					</Link>
					<Link
						:href="route('dashboard')"
						class="flex items-center justify-start gap-x-4 rounded-full py-2 px-4 transition hover:bg-ghost/20"
					>
						<span>
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
								class="feather feather-file-text inline h-4 w-4"
							>
								<path
									d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"
								></path>
								<polyline points="14 2 14 8 20 8"></polyline>
								<line x1="16" y1="13" x2="8" y2="13"></line>
								<line x1="16" y1="17" x2="8" y2="17"></line>
								<polyline points="10 9 9 9 8 9"></polyline>
							</svg>
						</span>

						<span
							:class="[
								'origin-left duration-300',
								isOpen ? '' : 'hidden ',
							]"
						>
							Posts
						</span>
					</Link>
					<Link
						:href="route('dashboard')"
						class="flex items-center justify-start gap-x-4 rounded-full py-2 px-4 transition hover:bg-ghost/20"
					>
						<span>
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
								class="feather feather-grid inline h-4 w-4"
							>
								<rect x="3" y="3" width="7" height="7"></rect>
								<rect x="14" y="3" width="7" height="7"></rect>
								<rect x="14" y="14" width="7" height="7"></rect>
								<rect x="3" y="14" width="7" height="7"></rect>
							</svg>
						</span>

						<span
							:class="[
								'origin-left duration-300',
								isOpen ? '' : 'hidden ',
							]"
						>
							Categories
						</span>
					</Link>
				</div>

				<div class="">
					<Link
						:href="route('logout')"
						method="post"
						as="button"
						class="flex w-full items-center gap-x-4 rounded-full py-2 px-4 transition hover:bg-ghost/20"
					>
						<span>
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
								class="feather feather-log-out inline h-4 w-4"
							>
								<path
									d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"
								></path>
								<polyline points="16 17 21 12 16 7"></polyline>
								<line x1="21" y1="12" x2="9" y2="12"></line>
							</svg>
						</span>

						<span
							:class="[
								'origin-left duration-300',
								isOpen ? '' : 'hidden',
							]"
						>
							Logout
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
