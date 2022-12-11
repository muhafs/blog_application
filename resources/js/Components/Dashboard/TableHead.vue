<template>
	<tr>
		<th class="py-3 px-6">#</th>
		<th class="py-3 px-6" v-for="head in heads" :key="head">{{ head }}</th>
		<th class="py-3 px-6 text-center">Action</th>
	</tr>
</template>

<script setup>
const props = defineProps(["heads"]);
</script>
