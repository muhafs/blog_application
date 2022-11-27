<template>
	<Transition name="fade" appear>
		<div
			v-show="isOpen"
			@click="$emit('close-modal')"
			class="absolute top-0 left-0 right-0 bottom-0 z-40 bg-black/30"
		></div>
	</Transition>

	<Transition name="slide" appear>
		<div
			v-show="isOpen"
			class="fixed top-1/2 left-1/2 z-50 w-full max-w-2xl -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-3xl bg-white"
		>
			<header
				class="w-full bg-primary px-8 py-4 text-center text-xl font-bold uppercase text-secondary"
			>
				create
			</header>

			<main class="px-8 py-4">
				<slot></slot>
			</main>

			<footer
				class="flex justify-between border-t border-primary/20 px-8 py-4"
			>
				<slot name="footer"></slot>
			</footer>
		</div>
	</Transition>
</template>

<script setup>
const props = defineProps(["isOpen"]);
const emits = defineEmits(["close-modal"]);
</script>

<style>
.fade-enter-active,
.fade-leave-active {
	transition: opacity 0.5s;
}

.fade-enter-from,
.fade-leave-to {
	opacity: 0;
}

.slide-enter-active,
.slide-leave-active {
	transition: transform 0.5s;
}

.slide-enter-from,
.slide-leave-to {
	transform: translate(100vw, -50%);
}
</style>
