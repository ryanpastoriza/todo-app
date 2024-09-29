import { ref } from 'vue'
import axios from 'axios'
import { useRouter } from 'vue-router'

export default function useTask() {
    const tags = ref([]);
 
    const getTags = async () => {

        let response = await axios.get('/api/tags');
        tags.value = response.data

    };
 
    return {
        tags,
        getTags,
    }
}