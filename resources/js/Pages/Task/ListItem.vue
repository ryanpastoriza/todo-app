<template>

	<div class="block rounded-lg bg-white shadow-secondary-1 dark:bg-surface-dark dark:text-white text-surface">

		<div class="p-4">
			<div class="flex justify-end flex-row">
				
			
				<EditButton></EditButton>
				<CompleteButton></CompleteButton>
				<IncompleteButton></IncompleteButton>
				<ArchiveButton></ArchiveButton>	
				<RestoreButton></RestoreButton>	
		 		<DeleteButton></DeleteButton>	
		

			</div>
		  <!-- 	<div class="mb-2">
		  		<router-link :to="{ name: 'edit-task' , params: { id: 'id' } }">
		  			<Button />
				</router-link>
		    </div> -->
		    <div class="flex flex-col">
			    <div class="h-75">
				    <h5 class="mb-2 text-xl font-medium leading-tight">
				      {{ props.item.title }}
				    </h5>

				    <p class="mb-4 text-base">
				      {{props.item.description}}
				    </p>
			    </div>

			    <div class="h25">
				    <div class="mb-1">
				    	<Date :duedate="props.item.due_date" />
				    </div>

				    <div class="mb-1">
						<Tags :tags="props.item.tags" />
				  	</div>
			  	</div>
		  	</div>

		</div>
		  
	</div>
</template>

<script>

import Date from '../../components/Task/Date.vue';
import Tooltip from '../../components/Task/Tooltip.vue';
import Tags from '../../components/Task/Tags.vue';
import EditButton from '../../components/Task/EditButton.vue';
import DeleteButton from '../../components/Task/DeleteButton.vue';
import CompleteButton from '../../components/Task/CompleteButton.vue';
import ArchiveButton from '../../components/Task/ArchiveButton.vue';
import IncompleteButton from '../../components/Task/IncompleteButton.vue';
import RestoreButton from '../../components/Task/RestoreButton.vue';
import { initFlowbite } from 'flowbite';
import { onMounted } from 'vue';

export default {

	components: {
		Date,
		Tooltip,
		Tags,
		EditButton,
		DeleteButton,
		CompleteButton,
		ArchiveButton,
		IncompleteButton,
		RestoreButton
	},

	props: {
		item:{
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