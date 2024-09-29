<template>
	<button 
		data-tooltip-target="edit-task-tooltip" type="button" class="border-none text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-xs px-1 py-1 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-1 mb-1"
	>
		<svg class="w-[16px] h-[16px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M8.586 2.586A2 2 0 0 1 10 2h4a2 2 0 0 1 2 2v2h3a1 1 0 1 1 0 2v12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V8a1 1 0 0 1 0-2h3V4a2 2 0 0 1 .586-1.414ZM10 6h4V4h-4v2Zm1 4a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Zm4 0a1 1 0 1 0-2 0v8a1 1 0 1 0 2 0v-8Z" clip-rule="evenodd"/>
</svg>


	</button>

	<div 
		id="edit-task-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-lg 	shadow-sm opacity-0 tooltip dark:bg-gray-700">
	    Edit
		<div class="tooltip-arrow" data-popper-arrow></div>
	</div>

</template>


<script>

import { onMounted } from 'vue';
import { initFlowbite } from 'flowbite';

export default {

	setup() {

		onMounted(() => {
		    initFlowbite();
		});
	}
};

</script>