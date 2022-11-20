<script setup>
import { computed, onMounted, ref } from "vue";

import ApplicationLogo from "@/Components/ApplicationLogo.vue";

import NavLink from "@/Components/NavLink.vue";
import ResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import SignButton from "@/Components/SignButton.vue";
import Dropdown from "@/Components/Dropdown.vue";
import DropdownLink from "@/Components/DropdownLink.vue";
import { usePage } from "@inertiajs/inertia-vue3";

const showingNavigationDropdown = ref(false);

const user = computed(() => usePage().props.value.auth.user);
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
						<SignButton
							:url="route('login')"
							content="Login"
							v-if="!user"
						/>
						<div class="relative ml-3" v-else>
							<Dropdown align="right" width="48">
								<template #trigger>
									<span class="inline-flex rounded-md">
										<button
											type="button"
											class="inline-flex items-center rounded-md border border-transparent bg-primary px-3 py-2 text-sm font-medium leading-4 text-secondary transition duration-150 ease-in-out hover:text-secondary/80 focus:outline-none"
										>
											{{ user.name }}
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
									<DropdownLink
										:href="route('admin')"
										method="get"
										as="button"
									>
										Dashboard
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
