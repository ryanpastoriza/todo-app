<template>

    <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Name" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />

                 <InputError v-for="(item, index) in errors.name" class="mt-2" :message="item" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError v-for="(item, index) in errors.email" class="mt-2" :message="item" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />

                <InputError v-for="(item, index) in errors.password" class="mt-2" :message="item" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirm Password" />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />

                 <InputError v-for="(item, index) in errors.password_confirmation" class="mt-2" :message="item" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <RouterLink to="/login" 
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    
                    Already registered?
                </RouterLink>
           

                <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </PrimaryButton>
            </div>
    </form>

  

</template>

<script>

import Checkbox from '@/Components/Checkbox.vue';
// import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Link from '@/Components/TextInput.vue';
import { ref, reactive, onMounted } from 'vue';
// import { Head, Link, useForm } from '@inertiajs/vue3';
// import { ref, reactive, onMounted } from 'vue';
// import { useRouter } from 'vue-router';

export default {

    components: {
        Checkbox,
        // GuestLayout,
        InputError,
        InputLabel,
        PrimaryButton,
        TextInput,
    },

    setup() {

        const errors = ref({});

        const initialForm = () => ({
            name: '',
            email: '',
            password: '',
            password_confirmation: '',
        });

        const form = reactive(initialForm());

        const submit = () => {
           
        };

        return {
            form,
            submit,
            errors
        }

        // onMounted(() => {
        //     initFlowbite();
        // });

    }
};

    
</script>