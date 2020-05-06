<template>
  <div>
    <v-snackbar
        v-model="snackbar.status"
    >
        {{snackbar.text}}
    <v-btn
        text
        @click="snackbar.status = false"
    >
        Х
    </v-btn>
    </v-snackbar>

    <v-row>
        <v-col>
            <div class="elevation-1 px-2">
            <v-toolbar flat color="white">
                <v-toolbar-title>Загальна інформація</v-toolbar-title>
            </v-toolbar>
            <v-textarea
                v-model="info.about"
                @blur="editInfo('about')"
                label="Опис сайту"
                rows="5"
                required
                outlined
                dense
            ></v-textarea>

            <v-text-field
                v-model="info.email"
                @blur="editInfo('email')"
                label="Email"
                required
                outlined
                dense
            ></v-text-field>

            <v-text-field
                v-model="info.phone"
                @blur="editInfo('phone')"
                label="Телефон"
                required
                outlined
                dense
            ></v-text-field>

            <v-text-field
                v-model="info.address"
                @blur="editInfo('address')"
                label="Адреса"
                required
                outlined
                dense
            ></v-text-field>
            </div>
        </v-col>

        <v-col>
            <Socials></Socials>
        </v-col>
    </v-row>
  </div>
</template>

<script>

import Socials from './includes/Socials';

  export default {
    data: () => ({
        info: {
            about: "",
            email: "",
            address: "",
            phone: ""
        },
        snackbar: {
            status: false,
            text: "",
        },
    }),
    components: {
        Socials
    },
    created() {
        this.getInfo();
    },
    methods: {
        getInfo() {
            axios.get('/api/info')
                .then((response) => {
                    response.data.map(item => {
                        this.info[item.key] = item.value;
                    })
                })
        },
        editInfo(key) {
            axios.post('/api/info', {
                key,
                text: this.info[key]
            }).then(() => {
                this.snackbar.status = true;
                this.snackbar.text = "Збережено";
            })
        }
    }
  }
</script>