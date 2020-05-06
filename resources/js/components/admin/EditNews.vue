<template>
    <div>
        <Snackbar :snackbar="snackbar"></Snackbar>
        <v-btn to="/admin/news" color="primary" dark class="mb-2">Всі новини</v-btn>
        <v-row>
            <v-col>
                <form>
                    <v-text-field
                        v-model="data.title"
                        label="Назва"
                        required
                        outlined
                        dense
                    ></v-text-field>

                    <v-textarea
                        v-model="data.text"
                        label="Опис"
                        rows="3"
                        required
                        outlined
                        dense
                    ></v-textarea>

                    <v-file-input 
                        @change="previewFiles($event)"
                        v-model="photo"
                        label="Зображення" 
                        outlined 
                        dense
                    ></v-file-input>

                    <v-img class="mb-4" v-if="previewPhoto" :src="previewPhoto" aspect-ratio="1.7"></v-img>

                    <v-btn @click="publish">Зберегти</v-btn>
                </form>
            </v-col>

            <v-col>
            </v-col>
        </v-row>
    </div>
</template>

<script>

import Snackbar from './includes/Snackbar';

export default {
    data: () => ({
        snackbar: {
            status: false,
            text: "",
        },
        data: {
            title: "",
            text: ""
        },
        previewPhoto: null,
        photo: null
    }),

    components: {
        Snackbar
    },

  created() {
    this.getData();
  },

  methods: {
    previewFiles(event) {
        if (event) {
            var reader = new FileReader();
            reader.onload = (e) => {
                this.previewPhoto = e.target.result;
            }
            reader.readAsDataURL(event);
        }
    },
    getData() {
        axios.get('/api/news/'+this.$route.params.id)
            .then((response) => {
                this.data = response.data;
                this.previewPhoto = this.data.photo;
            })
    },
    publish() {
        var form = new FormData;
        form.append('title', this.data.title);
        form.append('text', this.data.text);
        if(this.photo) {
            form.append('photo', this.photo);
        }
        axios.post('/api/news/'+this.$route.params.id, form)
            .then(() => {
                this.snackbar.status = true;
                this.snackbar.text = "Збережено";
            })
            .catch(() => {
                this.snackbar.status = true;
                this.snackbar.text = "Помилка";
            })
    }
  }
}
</script>