<script setup>
import PostDetailCard from "@/Components/PostDetailCard.vue";

const props = defineProps(["post"]);
</script>

<template>
	<!-- Browser Title -->
	<Head title="Muhamad Blog - Blog" />

	<!-- Main -->
	<PostDetailCard :post="post" />
</template>
