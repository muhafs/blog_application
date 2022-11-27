<template>
	<Head title="Post" />

	<h2>Show</h2>
	<p>
		<span>{{ post.id }}</span> <br />
		{{ post.title }}
	</p>

	<pre class="overflow-x-scroll rounded bg-primary p-4 text-secondary">
		{{ post }}
	</pre
	>
</template>

<script setup>
const props = defineProps(["post"]);
</script>
