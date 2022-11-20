<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
import { ref } from "vue";

const isOpen = ref(false);
</script>

<template>
	<div>
		<div class="flex">
			<!-- Navigation Bar -->
			<nav
				:class="[
					'relative  min-h-screen  bg-primary p-4 pt-8 duration-300',
					isOpen ? 'w-72' : 'w-20',
				]"
			>
				<!-- Slider Icon -->
				<span
					@click="isOpen = !isOpen"
					:class="[
						'absolute -right-4 top-7 grid h-8 w-8 cursor-pointer place-items-center rounded-full border border-primary bg-secondary text-sm font-bold uppercase text-primary duration-300',
						isOpen ? 'rotate-180' : '',
					]"
					>🚀</span
				>

				<!-- Logo Icon -->
				<div class="mb-4 flex justify-center">
					<ApplicationLogo
						:content="!isOpen ? 'MB' : 'Muhamad Blog'"
					/>
				</div>

				<hr class="border-ghost/20" />

				<!-- Links -->
				<ul class="mb-12 pt-2">
					<Link
						:href="route('admin')"
						class="flex cursor-pointer items-center gap-x-4 rounded-full py-2 px-3 text-sm text-secondary hover:bg-ghost/10"
					>
						<span class="block text-lg">😎</span>

						<span
							v-show="isOpen"
							class="flex-1 text-base font-medium"
						>
							Dashboard
						</span>
					</Link>
				</ul>

				<hr class="border-ghost/20" />

				<!-- Links -->
				<ul class="pt-2">
					<Link
						:href="route('home')"
						method="get"
						class="flex cursor-pointer items-center gap-x-4 rounded-full py-2 px-3 text-sm text-secondary hover:bg-ghost/10"
					>
						<span class="block text-lg">🏠</span>

						<span
							v-show="isOpen"
							class="flex-1 text-base font-medium"
						>
							Home Page
						</span>
					</Link>
					<Link
						:href="route('logout')"
						method="post"
						class="flex cursor-pointer items-center gap-x-4 rounded-full py-2 px-3 text-sm text-secondary hover:bg-ghost/10"
					>
						<span class="block text-lg">✈</span>

						<span
							v-show="isOpen"
							class="flex-1 text-base font-medium"
						>
							Logout
						</span>
					</Link>
				</ul>
			</nav>

			<!-- Page Content -->
			<main class="w-full p-8">
				<slot />
			</main>
		</div>
	</div>
</template>
