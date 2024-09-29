<template>
    <form @submit.prevent="login(form)">
        <div>
            <InputLabel for="email" value="Email" />

            <TextInput
                id="email"
                type="email"
                class="mt-1 block w-full"
                v-model="form.email"
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
                autocomplete="current-password"
            />

            <InputError v-for="(item, index) in errors.password" class="mt-2" :message="item" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton class="ms-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Log in
            </PrimaryButton>
        </div>
    </form>
</template>

<script>

import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import Link from '@/Components/TextInput.vue';
import { ref, reactive, onMounted } from 'vue';
import useAuth from '@/composables/useAuth.js'

export default {

    components: {
        Checkbox,
		InputError,
		InputLabel,
		PrimaryButton,
		TextInput,
    },

    setup() {

        const { login, errors } = useAuth();

        const initialForm = () => ({
            email: 'macy87@example.net',
            password: 'password',
        });

        const form = reactive(initialForm());
   
        return {
            form,
            login,
            errors
        }

    }
};

	
</script>