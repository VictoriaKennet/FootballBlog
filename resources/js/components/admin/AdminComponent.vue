<template>
    <div>
        <navigation></navigation>
        <v-content>
            <v-container>
                <router-view></router-view>
            </v-container>
        </v-content>
    </div>
</template>

<script>
    import Navigation from './includes/Navigation.vue'
    import Snackbar from './includes/Snackbar.vue'
    export default {
        name: 'admin',
        components: {
            Navigation,
            Snackbar
        },
    }
</script>
