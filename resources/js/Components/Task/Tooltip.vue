<template>
	<button data-tooltip-target="new-task" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">{{ props.title }}</button>

    <div 
        id="new-task" role="tooltip" class="absolute z-10 invisible inline-block px-2 py-1 text-xs font-medium text-white bg-gray-700 rounded-lg   shadow-sm opacity-0 tooltip dark:bg-gray-700">
        {{ tip }}
        <div class="tooltip-arrow" data-popper-arrow></div>
    </div>
</template>

<script>

import { defineProps, onMounted } from 'vue';
import { initFlowbite } from 'flowbite';

export default {

    props: {
	    title: String,
	    tip: String
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