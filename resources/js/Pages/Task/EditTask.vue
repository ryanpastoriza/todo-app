<template>
	<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
		<router-link :to="{ name: 'dashboard'}" type="button" 
				class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 me-2 mb-2">
			
				<svg 
					class="w-6 h-6 text-gray-800 dark:text-white" 
					aria-hidden="true" 
					xmlns="http://www.w3.org/2000/svg" 
					width="24" 
					height="24" 
					fill="none" 
					viewBox="0 0 24 24"
				>
					<path 
						stroke="currentColor" 
						stroke-linecap="round" 
						stroke-linejoin="round" 
						stroke-width="2" 
						d="M5 12h14M5 12l4-4m-4 4 4 4"
					/>
				</svg> 
				Back to Task List
		
        </router-link>
		<task-form />
    </div>
	
</template>

<script>

import TaskForm from '../Task/TaskForm.vue';

export default {

	components: {
		TaskForm,
	},

	setup() {

		return {

		}
	}


};

</script>