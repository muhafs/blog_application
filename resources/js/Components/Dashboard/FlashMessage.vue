<template>
	<div
		v-if="$page.props.flash.message"
		class="text-secondar rounded-full bg-primary px-4 py-1 text-secondary"
	>
		{{ $page.props.flash.message }}
	</div>
</template>

<script setup></script>
