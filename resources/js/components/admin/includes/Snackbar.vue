<template>
    <v-snackbar
        v-model="$props.snackbar.status"
    >
        {{$props.snackbar.text}}
    <v-btn
        text
        @click="$props.snackbar.status = false"
    >
        Х
    </v-btn>
    </v-snackbar>
</template>

<script>
export default {
    props: ['snackbar']
}
</script>