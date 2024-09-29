<template>

    <AuthenticatedLayout v-if="authenticated">
    <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">My Tasks</h2>
    </template>

    <router-view v-slot="{ Component, route }">
        <div :key="route.name">
            <Component :is="Component" />
        </div>
    </router-view>
    </AuthenticatedLayout>

    <GuestLayout v-else> 
    <router-view v-slot="{ Component, route }">
        <div :key="route.name">
            <Component :is="Component" />
        </div>
    </router-view>
    </GuestLayout>


</template>

<script>

import useAuth from '@/composables/useAuth.js'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { reactive, onMounted } from 'vue'

export default {

    components: {
        AuthenticatedLayout,
        GuestLayout
    },

    setup() {

        const { authenticated, user, attempt } = useAuth()

        onMounted(() => {
            attempt()
        })

        return {
            authenticated,
            user,
        }

    }

};
  
</script>