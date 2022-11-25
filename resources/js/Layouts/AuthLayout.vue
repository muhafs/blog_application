<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { ref } from "vue";

const showingNavigationDropdown = ref(false);
</script>

<template>
	<div class="min-h-screen bg-ghost">
		<!-- Navigation Bar -->
		<nav class="bg-primary">
			<!-- Primary Navigation Menu -->
			<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
				<div class="flex h-16 justify-between">
					<div class="flex">
						<!-- Logo -->
						<div class="flex shrink-0 items-center">
							<Link :href="route('dashboard')">
								<ApplicationLogo class="block h-9 w-auto" />
							</Link>
						</div>

						<!-- Navigation Links -->
						<div
							class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
						>
							<NavLink
								:href="route('dashboard')"
								:active="route().current('dashboard')"
							>
								Dashboard
							</NavLink>

							<NavLink
								:href="route('dashboard.posts.index')"
								:active="route().current('dashboard.posts*')"
							>
								Posts
							</NavLink>

							<NavLink
								:href="route('dashboard.categories.index')"
								:active="
									route().current('dashboard.categories*')
								"
							>
								Categories
							</NavLink>
						</div>
					</div>

					<div class="hidden sm:ml-6 sm:flex sm:items-center">
						<!-- Settings Dropdown -->
						<div class="relative ml-3">
							<Dropdown align="right" width="48">
								<template #trigger>
									<span class="inline-flex rounded-md">
										<button
											type="button"
											class="inline-flex items-center rounded-md border border-transparent bg-primary px-3 py-2 text-sm font-medium leading-4 text-secondary transition duration-150 ease-in-out hover:text-secondary/80 focus:outline-none"
										>
											{{ $page.props.auth.user.name }}

											<svg
												class="ml-2 -mr-0.5 h-4 w-4"
												xmlns="http://www.w3.org/2000/svg"
												viewBox="0 0 20 20"
												fill="currentColor"
											>
												<path
													fill-rule="evenodd"
													d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
													clip-rule="evenodd"
												/>
											</svg>
										</button>
									</span>
								</template>

								<template #content>
									<DropdownLink :href="route('home')">
										Home Page
									</DropdownLink>

									<DropdownLink
										:href="route('logout')"
										method="post"
										as="button"
									>
										Log Out
									</DropdownLink>
								</template>
							</Dropdown>
						</div>
					</div>

					<!-- Hamburger -->
					<div class="-mr-2 flex items-center sm:hidden">
						<button
							@click="
								showingNavigationDropdown =
									!showingNavigationDropdown
							"
							class="inline-flex items-center justify-center rounded-md p-2 text-secondary transition duration-150 ease-in-out hover:bg-secondary hover:text-primary focus:bg-secondary/80 focus:text-primary/80 focus:outline-none"
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
						:href="route('dashboard')"
						:active="route().current('dashboard')"
					>
						Dashboard
					</ResponsiveNavLink>

					<ResponsiveNavLink
						:href="route('dashboard.posts.index')"
						:active="route().current('dashboard.posts*')"
					>
						Posts
					</ResponsiveNavLink>

					<ResponsiveNavLink
						:href="route('dashboard.categories.index')"
						:active="route().current('dashboard.categories*')"
					>
						Categories
					</ResponsiveNavLink>
				</div>

				<!-- Responsive Settings Options -->
				<div class="border-t border-gray-200 pt-4 pb-1">
					<div class="px-4">
						<div class="text-base font-medium text-secondary">
							{{ $page.props.auth.user.name }}
						</div>
						<div class="text-sm font-medium text-ghost">
							{{ $page.props.auth.user.email }}
						</div>
					</div>

					<div class="mt-3 space-y-1">
						<ResponsiveNavLink :href="route('home')">
							Home
						</ResponsiveNavLink>

						<ResponsiveNavLink
							:href="route('logout')"
							method="post"
							as="button"
							class="w-full text-start"
						>
							Log Out
						</ResponsiveNavLink>
					</div>
				</div>
			</div>
		</nav>

		<!-- Page Content -->
		<main class="container py-8">
			<!-- <div class="rounded-xl bg-white p-8 shadow-xl"> -->
			<slot />
			<!-- </div> -->
		</main>
	</div>
</template>
