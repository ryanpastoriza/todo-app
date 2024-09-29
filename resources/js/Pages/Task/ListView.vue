<template>
	<div class="grid grid-cols-3 gap-4 mb-4">
        <list-item v-for="(task, index) in props.tasks" :item="task"></list-item>
    </div>

    <div>
    	 <div class="flex flex-col items-center">
          <!-- Help text -->
          <span class="text-sm text-gray-700 dark:text-gray-400">
              Showing 
              <span class="font-semibold text-gray-900 dark:text-white">
              	{{ props.meta.from }}
              </span> 
              to 
              <span class="font-semibold text-gray-900 dark:text-white">
              	{{ props.meta.to }}
          </span> 
              of 
              <span class="font-semibold text-gray-900 dark:text-white">
              	{{ props.meta.total }}
              </span> 
              Entries
          </span>
          <!-- Buttons -->
          <div class="inline-flex mt-2 xs:mt-0">
              <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                  Prev
              </button>
              <button class="flex items-center justify-center px-3 h-8 text-sm font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                  Next
              </button>
          </div>
        </div>
    </div>
	
</template>

<script>

import ListItem from '../Task/ListItem.vue';	
import useTask from '@/composables/useTask.js';
import { onMounted, onUpdated } from 'vue';

export default {

	components: {
		ListItem
	},

	props: {
		tasks:{
			type: Object
		},
		meta:{
			type: Object
		}
	},

	setup(props) {

		// onUpdated(() => {
			
		// })

		// onMounted(() => {
		// 	console.log(props.tasks)
		// 	// getTaskCollection()
		// })

		return {
			props,	
		}
	}


};

</script>