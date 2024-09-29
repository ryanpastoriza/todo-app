<template>

   <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

    <div class="flex items-center justify-center py-4 flex-wrap">


        
      <!--   <button @click.prevent="taskCollections.incomplete=true" type="button" class="inactiveClass">

        Todo
        </button>

        <button @click.prevent="taskCollections.complete=true" type="button" class="">

        Completed
        </button> -->

        <button 
            v-for="(filter, index) in filters" 
            :key="index" 
            @click="filterTodo(filter)"  
            :class="filter === activeFilter ? activeClass : inactiveClass" 
            type="button" 
            >

        {{ filter }}
        </button>
    </div>

        <!-- <div class="bg-white rounded-lg mb-4 p-3">
            <div class="text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700">
                <ul class="flex flex-wrap -mb-px">
                    <li class="me-2">
                        <a href="#" class="active inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg dark:text-blue-500 dark:border-blue-500">Todo</a>
                    </li>
                    <li class="me-2">
                        <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" aria-current="page">Completed</a>
                    </li>
                    <li class="me-2">
                        <a href="#" class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Archived</a>
                    </li>
                </ul>
            </div>
        </div> -->


    </div>

    <div class="flex flex-row gap-3 items-center max-w-7xl mx-auto sm:px-6 lg:px-8 mb-5">

        <div>
          <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            <option selected>Priority</option>
            <option value="US">United States</option>
            <option value="CA">Canada</option>
            <option value="FR">France</option>
            <option value="DE">Germany</option>
          </select>

        </div>  
        <div class="">
            <router-link :to="{ name: 'create-task'}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-4 py-2 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
               Add Task
            </router-link>
        </div>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <list-view  :tasks="tasks" :meta="meta"></list-view>

    </div>


  
</template>

<script>

// import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
// import TaskView from '../Pages/Task/Index.vue';
// import Tooltip from '../components/Task/Tooltip.vue';
import { ref, reactive, computed, onMounted } from 'vue';
import useTask from '@/composables/useTask.js';
// import { initFlowbite } from 'flowbite'
import ListView from './Task/ListView.vue';

export default {

    components: {
        ListView,
    },

    props: {

    },

    setup() {

        const { meta, tasks, getTasksIncomplete, getTasksComplete, getTasksArchived } = useTask();

        const filters = ref(['Incomplete', 'Complete', 'Archive']);

        const activeFilter = ref('Incomplete');

        const metaFilters = reactive({
            due_date: {
                from: '',
                to: ''
            },
            created_at: {
                from: '',
                to: ''
            },
            completed_at: {
                from: '',
                to: ''
            },
            priority: '',
            search: '',
            sort: '',
            order: '',
            page: 1,
        });

        const filterTodo = (type) => {
            activeFilter.value = type;
            getTaskCollection()
        }

        const getTaskCollection = async() => {
            if( activeFilter.value == 'Incomplete' ) {
                await getTasksIncomplete()
            }

            if( activeFilter.value == 'Complete' ) {
                await getTasksComplete()
            }

            if( activeFilter.value == 'Archive' ) {
                await getTasksArchived()
            }

        }

        const activeClass ='text-blue-700 hover:text-white border border-blue-600 bg-white hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:bg-gray-900 dark:focus:ring-blue-800'
    
        const inactiveClass = 'text-gray-900 border border-white hover:border-gray-200 dark:border-gray-900 dark:bg-gray-900 dark:hover:border-gray-700 bg-white focus:ring-4 focus:outline-none focus:ring-gray-300 rounded-full text-base font-medium px-5 py-2.5 text-center me-3 mb-3 dark:text-white dark:focus:ring-gray-800';

        onMounted(() => {
            // initFlowbite();
            getTaskCollection()

            console.log(tasks);
        });

        return {
            filters,
            activeFilter,
            filterTodo,
            activeClass,
            inactiveClass,
            tasks,
            meta
        }
    }
};

    
</script>

<style scoped>
</style>