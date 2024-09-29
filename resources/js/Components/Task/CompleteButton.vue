<template>
	<button 
		data-tooltip-target="edit-task-tooltip" type="button" class="border-none text-gray-900 bg-white hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-xs px-1 py-1 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 me-1 mb-1"
	>
		<svg class="w-[16px] h-[16px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
  <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm13.707-1.293a1 1 0 0 0-1.414-1.414L11 12.586l-1.793-1.793a1 1 0 0 0-1.414 1.414l2.5 2.5a1 1 0 0 0 1.414 0l4-4Z" clip-rule="evenodd"/>
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