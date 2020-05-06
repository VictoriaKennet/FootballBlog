<template>
    <div>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-card>
            <v-card-text>
            <v-container>
                <b>ПІБ:</b> {{member.name}};<br>
                <b>Телефон:</b> {{member.phone}};<br>
                <b>Email:</b> {{member.email}};<br>
                <b>Вік:</b> {{member.age}};<br>
                <b>Додаткова інформація:</b> {{member.info}};<br>
                <br>
                <v-text-field 
                    v-model="member.optional_time" 
                    label="Час проведення" 
                    outlined
                    dense
                    required
                ></v-text-field>

                <v-textarea
                    v-model="member.purpose"
                    label="Мета заняття"
                    rows="3"
                    required
                    outlined
                    dense
                ></v-textarea>
            </v-container>
            </v-card-text>
            <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialog = false">Закрити</v-btn>
            <v-btn color="blue darken-1" text @click="addToSchedule()">Зберегти</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
    <v-data-table
        :headers="headers"
        :loading="loading"
        :items="data"
        sort-by="calories"
        class="elevation-1"
    >
    <template v-slot:top>
        <v-toolbar flat color="white">
            <v-toolbar-title>Заявки</v-toolbar-title>
        </v-toolbar>
    </template>

    <template v-slot:item.actions_status="{ item }">
        <v-btn icon @click="openDialog(item)">
            <v-icon>add_box</v-icon>
        </v-btn>
    </template>

      <template v-slot:item.actions="{ item }">
        <v-btn icon @click="deleteItem(item)">
            <v-icon>mdi-delete</v-icon>
        </v-btn>
      </template>
    </v-data-table>
    </div>
</template>

<script>
  export default {
    data: () => ({
        dialog: false,
        loading: true,
        editIndex: null,
        member: {
            name: '',
            phone: '',
            email: '',
            age: '',
            info: '',
            optional_time: '',
            purpose: ''
        },
        headers: [
            { text: '', value: 'actions_status', width: "20px" },
            { text: 'ПІБ', value: 'name' },
            { text: 'Email', value: 'email' },
            { text: 'Телефон', value: 'phone' },
            { text: 'Вік', value: 'age' },
            { text: 'Додаткова інформація', value: 'info' },
            { text: 'Бажаний час', value: 'optional_time' },
            { text: '', value: 'actions', sortable: false, align: 'right' },
        ],
        data: []
    }),

  created() {
    this.getData();
  },

    methods: {
        getData() {
          axios.get('/api/applications')
            .then((response) => {
              this.data = response.data;
              this.loading = false;
            })
        },
        deleteItem(item) {
          axios.delete('/api/applications/'+item.id)
            .then((response) => {
              const index = this.data.indexOf(item)
              this.data.splice(index, 1)
            })
        },
        openDialog(item) {
            this.dialog = !this.dialog;
            Object.assign(this.member, item);
            this.editIndex = this.data.indexOf(item);
        },
        addToSchedule() {
          axios.post('/api/schedule', this.member)
            .then(() => {
                this.dialog = !this.dialog;
                this.data.splice(this.editIndex, 1);
            })
        }
    }
  }
</script>