<template>
	<button 
		data-tooltip-target="edit-task-tooltip" type="button" class="border-none text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-xs px-1 py-1 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-1 mb-1"
	>
		<svg class="w-[16px] h-[16px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 9h13a5 5 0 0 1 0 10H7M3 9l4-4M3 9l4 4"/>
</svg>


	</button>

	<div 
		id="edit-task-tooltip" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-lg 	shadow-sm opacity-0 tooltip dark:bg-gray-700">
	    Restore
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