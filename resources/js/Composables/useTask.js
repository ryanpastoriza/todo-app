import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useTask() {
    const task = ref([]);
    const tasks = ref([]);
    const meta = ref([]);
    const errors = ref([]);
    // const router = useRouter()
 
    const getTasksIncomplete = async (filters) => {

        let response = await axios.get('/api/tasks', filters);
        tasks.value = response.data.data;
        meta.value = response.data.meta;

        console.log(meta);

    };

    const getTasksComplete = async (filters) => {

        let response = await axios.get('api/user/completed-tasks', filters);
        tasks.value = response.data.data;
        meta.value = response.data.meta;
    };

    const getTasksArchived = async (filters) => {

        let response = await axios.get('api/user/archived-tasks', filters);
        tasks.value = response.data.data;
        meta.value = response.data.meta;

    };

    // const getUnstockedItems = async () => {

    //     let branch_id = localStorage.getItem('branch_id');
    //     let response = await axios.get('/api/unstocked/', { params: { branch_id: branch_id } });
    //     unstockedItems.value = response.data.data
    //     console.log(unstockedItems);
    // };
 
    const getTask = async (id) => {
        let response = await axios.get(`/api/task/${id}`)
        task.value = response.data.data

        console.log(task);
    };
 
    const storeTask = async (data) => {
        errors.value = ''

        try {
            let response = await axios.post('/api/tasks', data)
            task.value = response.data
            // Swal.fire({
            //   position: 'top-end',
            //   icon: 'success',
            //   title: 'Item created',
            //   showConfirmButton: false,
            //   timer: 1500,
            //   toast: true,
            // });
            console.log(task);
        } catch (e) {
            if (e.response.status === 422) {
                // for (const key in e.response.data.errors) {
                errors.value = e.response.data.errors
                console.log(e.response.data.errors);
                // }
            }
        }
    };

    const createNotification = () => {

        this.$swal('Hello Vue world!!!');

    };
 
    // const updateItem = async (id) => {
    //     errors.value = ''
    //     try {
    //         await axios.patch(`/api/item/${id}`, item.value)
    //         Swal.fire({
    //           position: 'top-end',
    //           icon: 'success',
    //           title: 'Item Updated',
    //           showConfirmButton: false,
    //           timer: 1500,
    //           toast: true,
    //         });
    //         // await router.push({ name: 'companies.index' })
    //     } catch (e) {
    //         if (e.response.status === 422) {
    //             for (const key in e.response.data.errors) {
    //                 errors.value = e.response.data.errors
    //             }
    //         }
    //     }
    // };

    // const destroyItem = async (id) => {
        
    //     let response = await axios.delete(`/api/item/${id}`);
        

    // };
 
    return {
        errors,
        meta,
        task,
        tasks,
        getTask,
        getTasksIncomplete,
        getTasksComplete,
        getTasksArchived,
        storeTask
    }
}