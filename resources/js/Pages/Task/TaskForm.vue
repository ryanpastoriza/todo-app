<template>
    <form @submit.prevent="create" novalidate>
  	<div class="bg-white dark:bg-gray-900 py-4 px-4 max-w-3xl lg:py-4 border border-gray-300">
      <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">New Task</h2>

        <div class="grid gap-4 sm:grid-cols-3 sm:gap-6">

                <div class="sm:col-span-2">
                  <InputLabel for="title" value="Title" />

                  <TextInput
                      id="title"
                      type="text"
                      class="mt-1 block w-full"
                      v-model="form.title"
                      required

                  />

                  <InputError v-for="(item, index) in errors.title" class="mt-2" :message="item" />
                </div>

                <div class="w-full">
                  <InputLabel for="due date" value="Due Date" />

                  <TextInput
                      id="duedate"
                      type="date"
                      v-model="form.due_date"
                      class="mt-1 block w-full"

                  />

                  <InputError v-for="(item, index) in errors.due_date" class="mt-2" :message="item" />
                </div>

                 <div class="sm:col-span-3">
                    <label class="block font-medium text-sm text-gray-700">Description</label>
                    <textarea 
                        rows="3" 
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm resize-none"
                        v-model="form.description"
                    >
                      
                    </textarea>

                    <InputError v-for="(item, index) in errors.description" class="mt-2" :message="item" />
                </div>

                <div class="w-full">
                    <label class="block font-medium text-sm text-gray-700">Priority</label>
                    <select 
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full"
                        v-model="form.priority"
                      >
                        <option value=""></option>
                        <option 
                            v-for="(level, index) in priorityLevels" :value="level"
                        >

                        {{ level }}
                        </option>

                    </select>

                    <InputError v-for="(item, index) in errors.priority" class="mt-2" :message="item" />
                </div>

                <div class="w-full">

                    <label class="block font-medium text-sm text-gray-700">Tags</label>
                    <button 
                        data-dropdown-toggle="dropdownTags"
                        class="mt-1 block w-full text-gray-900 bg-white border border-gray-300 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 flex justify-between" 

                        type="button"
                    >

                      Add tags to this task
                      <svg class="w-2.5 h-2.5 ms-3" 
                          aria-hidden="true" 
                          xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                              <path 
                                stroke="currentColor" 
                                stroke-linecap="round" 
                                stroke-linejoin="round" 
                                stroke-width="2" d="m1 1 4 4 4-4"
                              />

                      </svg>
                    </button>

                    <div 
                        id="dropdownTags"
                        class="z-10 hidden w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                        
                        <ul 
                            class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200">
                          <li 
                              v-for="(tag, index) in tags">
                            <div 
                                class="flex items-center">
                              <input 
                                  type="checkbox"
                                  :id="tag.id"
                                  :value="tag.id"
                                  v-model="form.tags"
                                  class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                              <label 
                                  class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"
                              >

                              {{ tag.name}}
                              </label>
                            </div>
                          </li>
                        </ul>
                    </div>

                    <InputError v-for="(item, index) in errors.tags" class="mt-2" :message="item" />
                </div>
           
        </div> 
    
    </div>

    <div class="flex items-center justify-start mt-4">
              
          <button 
            type="submit" 
            class="py-2.5 px-5 me-2 text-sm font-medium text-gray-900 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 inline-flex items-center">
           <!--  <svg 
                aria-hidden="true" 
                role="status" class="inline w-4 h-4 me-3 text-gray-200 animate-spin dark:text-gray-600" 
                viewBox="0 0 100 101" 
                fill="none" 
                xmlns="http://www.w3.org/2000/svg">
                <path 
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" 
                    fill="currentColor"
                />
                <path 
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" 
                    fill="#1C64F2"
                />
            </svg> -->
            Save Changes
          </button>

      </div>
      
    </form>

</template>

<script>

import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';

import { ref, reactive, computed, onMounted } from 'vue';
import { initFlowbite } from 'flowbite';
import useTags from '@/composables/useTags.js';
import useTask from '@/composables/useTask.js';

export default {

  components: {
    InputLabel,
    TextInput,
    PrimaryButton,
    InputError
  },

  props: {},

  setup(props) {

    const priorityLevels = ref([]);

    const initialForm = () => ({
        title: '',
        description: '',
        due_date: '',
        priority: '',
        tags: []

    });

    const form = reactive(initialForm());

    const { tags, getTags } = useTags();
    const { task, storeTask, errors } = useTask();

    const toggleTags = computed(() => {
      return form.tags;
    }); 
      
    const getPriorityLevels = async() => {
        let response = await axios.get('/api/priority-levels');
        priorityLevels.value = response.data
    };

    const create = async() => {

        if( !form.tags ) {
          form.tags = null
        }

        storeTask(form)
    }

    onMounted(() => {
        getTags();
        getPriorityLevels();
        initFlowbite();
    });

    return {
      props,
      priorityLevels,
      form,
      tags,
      create,
      errors
    }
  }
};

</script>