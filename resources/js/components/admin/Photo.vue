<template>
    <div>
        <template>
            <v-toolbar flat color="white">
                <v-toolbar-title>Фотогалерея</v-toolbar-title>
            </v-toolbar>
        </template>

        <v-row>
            <v-col md="6">
                <v-file-input 
                    multiple 
                    outlined 
                    dense 
                    label="Обрати зображення" 
                    v-model="photos"
                ></v-file-input>
            </v-col>
            <v-col md="6">
                <v-btn color="primary" @click="upload">Додати</v-btn>
            </v-col>
        </v-row>
        <v-row>
            <v-col md="3" v-for="photo in photosCard" :key="photo.id">
                <v-card>
                <v-img :src="photo.value">
                </v-img>
                <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn icon @click="deleteItem(photo)">
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
        photos: null,
        photosCard: [],
    }),
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/api/photos')
                .then((response) => {
                    this.photosCard = response.data
                })
        },
        upload() {
            var form = new FormData;
            for(let i = 0; i < this.photos.length; i++){
                form.append('pics[]', this.photos[i]);
            }
            axios.post('/api/photos', form)
                .then(() => {
                    this.getData();
                })
        },
        deleteItem(item) {
            axios.delete('/api/photos/'+item.id)
                .then(() => {
                    const index = this.photosCard.indexOf(item)
                    this.photosCard.splice(index, 1)
                })
        }
    }
}
</script>