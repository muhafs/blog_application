<script setup>
import { ref } from "vue";
import { Link } from "@inertiajs/inertia-vue3";

import ApplicationLogo from "@/Components/ApplicationLogo.vue";

import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import SignButton from "@/Components/SignButton.vue";

const showingNavigationDropdown = ref(false);
</script>

<template>
	<div class="min-h-screen bg-ghost">
		<nav class="bg-primary">
			<!-- Primary Navigation Menu -->
			<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
				<div class="flex h-16 items-center justify-between">
					<div class="flex h-full">
						<!-- Logo -->
						<div class="flex shrink-0 items-center">
							<Link :href="route('home')">
								<ApplicationLogo class="block h-9 w-auto" />
							</Link>
						</div>

						<!-- Navigation Links -->
						<div
							class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
						>
							<NavLink
								:href="route('home')"
								:active="route().current('home')"
							>
								Home
							</NavLink>

							<NavLink
								:href="route('about')"
								:active="route().current('about')"
							>
								About
							</NavLink>

							<NavLink
								:href="route('blog')"
								:active="route().current('blog*')"
							>
								Blog
							</NavLink>

							<NavLink
								:href="route('category')"
								:active="route().current('category*')"
							>
								Category
							</NavLink>
						</div>
					</div>

					<div class="flex gap-4">
						<SignButton :url="route('login')" content="Login" />

						<!-- Hamburger -->
						<div class="-mr-2 flex items-center sm:hidden">
							<button
								@click="
									showingNavigationDropdown =
										!showingNavigationDropdown
								"
								class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition duration-150 ease-in-out hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none"
							>
								<svg
									class="h-6 w-6"
									stroke="currentColor"
									fill="none"
									viewBox="0 0 24 24"
								>
									<path
										:class="{
											hidden: showingNavigationDropdown,
											'inline-flex':
												!showingNavigationDropdown,
										}"
										stroke-linecap="round"
										stroke-linejoin="round"
										stroke-width="2"
										d="M4 6h16M4 12h16M4 18h16"
									/>
									<path
										:class="{
											hidden: !showingNavigationDropdown,
											'inline-flex':
												showingNavigationDropdown,
										}"
										stroke-linecap="round"
										stroke-linejoin="round"
										stroke-width="2"
										d="M6 18L18 6M6 6l12 12"
									/>
								</svg>
							</button>
						</div>
					</div>
				</div>
			</div>

			<!-- Responsive Navigation Menu -->
			<div
				:class="{
					block: showingNavigationDropdown,
					hidden: !showingNavigationDropdown,
				}"
				class="sm:hidden"
			>
				<div class="space-y-1 pt-2 pb-3">
					<ResponsiveNavLink
						:href="route('home')"
						:active="route().current('home')"
					>
						Home
					</ResponsiveNavLink>

					<ResponsiveNavLink
						:href="route('about')"
						:active="route().current('about')"
					>
						About
					</ResponsiveNavLink>

					<ResponsiveNavLink
						:href="route('blog')"
						:active="route().current('blog')"
					>
						Blog
					</ResponsiveNavLink>
				</div>
			</div>
		</nav>

		<!-- Page Content -->
		<main>
			<div class="container mx-auto p-6">
				<slot />
			</div>
		</main>
	</div>
</template>
