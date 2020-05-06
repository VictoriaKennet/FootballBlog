<template>
    <div>
        <v-dialog v-model="dialog" persistent max-width="600px">
            <v-card>
                <v-card-text>
                <v-container>
                    <v-text-field v-model="editData.title" label="Назва" required></v-text-field>
                    <v-text-field v-model="editData.url" label="Посилання" required></v-text-field>
                    <v-file-input v-model="editData.logo" label="Логотип"></v-file-input>
                </v-container>
                </v-card-text>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close()">Закрити</v-btn>
                <v-btn color="blue darken-1" text @click="save()">Зберегти</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-data-table
            :headers="headers"
            :hide-default-footer="true"
            :items="data"
            :loading="loading"
            item-key="id"
            sort-by="calories"
            class="elevation-1"
        >
            <template v-slot:top>
                <v-toolbar flat color="white">
                <v-toolbar-title>Соціальні мережі</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn color="primary" @click="add" dark class="mb-2">Додати</v-btn>
                </v-toolbar>
            </template>
            <template v-slot:item.logo="{ item }">
                <v-img v-if="item.logo" :src="item.logo" width="30px"></v-img>
                <v-img v-else src="/img/default.png" width="30px"></v-img>
            </template>
            <template v-slot:item.actions="{ item }">
                <v-icon small @click="edit(item)">
                    mdi-pencil
                </v-icon>
                <v-icon small @click="deleteItem(item)">
                    mdi-delete
                </v-icon>
            </template>
        </v-data-table>
    </div>
</template>

<script>
export default {
    data: () => ({
        loading: true,
        dialog: false,
        editIndex: -1,
        headers: [
            { 
                text: '#',
                align: 'start', 
                value: 'id', 
                width: "10px"
            },
            { 
                text: 'Лототип', 
                value: 'logo',
            },
            { 
                text: 'Назва', 
                value: 'title',
            },
            { 
                text: 'Посилання', 
                value: 'url',
            },
            {
                text: '', 
                value: 'actions', 
                sortable: false, 
                align: 'right',
                width: "70px"
            },
        ],
        editData: {
            title: "",
            url: "",
            logo: null
        },
        data: []
    }),
    created() {
        this.getData();
    },
    methods: {
        getData() {
            axios.get('/api/socials')
                .then((response) => {
                    this.data = response.data;
                    this.loading = false;
                })
        },
        edit(item) {
            Object.assign(this.editData, item);
            this.editIndex = this.data.indexOf(item);
            this.dialog = true;
            this.editData.logo = null;
        },
        add() {
            this.editIndex = -1;
            this.dialog = true;
        },
        save() {
            var form = new FormData;
            if(this.editIndex == -1) {
                form.append('title', this.editData.title);
                form.append('url', this.editData.url);
                form.append('logo', this.editData.logo);
                axios.post('/api/social', form)
                    .then((response) => {
                        this.data.push(response.data);
                        this.close();
                    })
            } else {
                form.append('title', this.editData.title);
                form.append('url', this.editData.url);
                form.append('logo', this.editData.logo);
                axios.post('/api/social/'+this.editData.id, form)
                    .then(() => {
                        this.close();
                        this.getData();
                    })
            }
        },
        close() {
            this.dialog = false;
            this.editData = {};
        },
        deleteItem(item) {
            axios.delete('/api/social/'+item.id)
                .then(() => {
                    this.data.splice(this.data.indexOf(item), 1);
                    this.close();
                })
        }
    }
}
</script>