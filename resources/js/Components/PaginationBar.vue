<template>
	<nav>
		<ul class="flex justify-center -space-x-px">
			<li v-for="(link, index) in links" :key="index">
				<span
					v-if="link.url == null"
					:class="[
						'border border-gray-300 bg-white py-2 px-3 text-gray-400',
						{
							'rounded-l-lg ': index == 0,
							'rounded-r-lg': index == links.length - 1,
						},
					]"
					v-html="link.label"
				></span>
				<Link
					v-else
					:href="link.url"
					:class="[
						'border border-gray-300 bg-white py-2 px-3 text-gray-900',
						{
							'text-secondary': link.active,
							'rounded-l-lg ': index == 0,
							'rounded-r-lg': index == links.length - 1,
						},
					]"
					v-html="link.label"
				/>
			</li>
		</ul>
	</nav>
</template>

<script setup>
const props = defineProps(["links"]);
</script>
