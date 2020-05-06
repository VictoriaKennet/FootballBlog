<template>
    <div>
        <template>
            <v-toolbar flat color="white">
                <v-toolbar-title>Відеогалерея</v-toolbar-title>
            </v-toolbar>
        </template>
        <v-row>
            <v-col md="6">
                <v-text-field 
                    outlined 
                    dense 
                    label="Посилання на YouTude" 
                    v-model="video"
                ></v-text-field>
            </v-col>
            <v-col md="6">
                <v-btn color="primary" @click="upload">Додати</v-btn>
            </v-col>
        </v-row>
        <v-row>
            <v-col md="3" v-for="video in videosCard" :key="video.id">
                <v-card>
                <iframe v-if="video.value" width="100%" height="100%" :src="'https://www.youtube.com/embed/'+video.value.slice(video.value.length - 11, video.value.length)" frameborder="0" allowfullscreen></iframe>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn icon @click="deleteItem(video)">
                    <v-icon>mdi-delete</v-icon>
                    </v-btn>
                </v-card-actions>
                </v-card> 
            </v-col>
        </v-row>
    </div>
</template>

<script>
export default {
    name: 'photo',
    data: () => ({
        video: null,
        videosCard: [],
    }),
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/api/videos')
                .then((response) => {
                    this.videosCard = response.data
                })
        },
        upload() {
            axios.post('/api/videos', {value: this.video})
                .then(() => {
                    this.getData();
                })
        },
        deleteItem(item) {
            axios.delete('/api/videos/'+item.id)
                .then(() => {
                    const index = this.videosCard.indexOf(item)
                    this.videosCard.splice(index, 1)
                })
        }
    }
}
</script>