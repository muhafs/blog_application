<template>
	<Transition name="fade" appear>
		<div
			v-show="isOpen"
			@click="$emit('close-modal')"
			class="absolute top-0 left-0 right-0 bottom-0 z-40 min-h-screen bg-black/30"
		></div>
	</Transition>

	<Transition name="slide" appear>
		<div
			v-show="isOpen"
			class="fixed top-1/2 left-1/2 z-50 w-full max-w-4xl -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-3xl bg-white"
		>
			<slot></slot>
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
