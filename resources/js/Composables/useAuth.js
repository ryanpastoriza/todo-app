import { computed, reactive, ref } from 'vue'
import axios from 'axios'

const state = reactive({
    authenticated: false,
    user: {}
})

export default function useAuth() {
    const authenticated = computed(() => state.authenticated)
    const user = computed(() => state.user)
    const errors = ref({});

    const setAuthenticated = (authenticated) => {
        state.authenticated = authenticated
    }

    const setUser = (user) => {
        state.user = user
    }

    const login = async(credentials) => {
    
            await axios.post('/api/login', credentials)
            .then(response => {

                const token = response.data.token;
                localStorage.setItem('token', token);

                attempt()
                
            }).catch(error => {
                if( error.response ) {
                    errors.value = error.response.data.errors;    
                }
            });
    }

    const logout = async () => {
       
        await axios.post('/api/logout', credentials)
        attempt()
    }

    const attempt = async () => {
        try {
            let response = await axios.get('/api/user')
            // console.log(response);
            setAuthenticated(true)
            setUser(response.data)

            return response
        } catch (e) {
            setAuthenticated(false)
            setUser({})
            localStorage.removeItem('token');
        }
    }

    return {
        authenticated,
        user,
        login,
        attempt,
        errors
    }
}