<template>
    <div>
        <Snackbar :snackbar="snackbar"></Snackbar>
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

                    <v-img class="mb-4" v-if="photo && previewPhoto" :src="previewPhoto" style="width: 100%"></v-img>
                
                    <v-btn @click="publish">Опублікувати</v-btn>
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
        text: "",
    },
    previewPhoto: null,
    photo: null
  }),

    components: {
        Snackbar
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
    publish() {
        var form = new FormData;
        form.append('title', this.data.title);
        form.append('text', this.data.text);
        if(this.photo) {
            form.append('photo', this.photo);
        }
        axios.post('/api/news', form)
            .then((response) => {
                this.snackbar.status = true;
                this.snackbar.text = "Додано";
            })
            .catch(() => {
                this.snackbar.status = true;
                this.snackbar.text = "Помилка";
            })
    }
  }
}
</script>