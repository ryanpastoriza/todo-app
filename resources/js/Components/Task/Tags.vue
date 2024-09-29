<template>
	 <ul class="flex flex-wrap gap-2 pt-4 text-sm text-gray-600 *:rounded-full *:border *:border-gray-100 *:bg-gray-50 *:px-2 *:py-0.5 dark:text-gray-300 dark:*:border-gray-500/15 dark:*:bg-gray-500/10">
	    <li v-for="(tag, index) in props.tags">{{ tag.name }}</li>
	  </ul>
</template>


<script>

import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';

export default {

	props: {
		tags:{
			type: Object
		}
	},

	setup(props) {

		onMounted(() => {
		    initFlowbite();
		});

		return {
			props
		}
	}
};

</script>