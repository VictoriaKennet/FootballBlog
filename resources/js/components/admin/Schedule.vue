<template>
  <div>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-card>
            <v-card-text class="pt-4">
            <v-container>
                <v-text-field 
                    v-model="member.name" 
                    label="Учасник" 
                    outlined
                    dense
                    required
                ></v-text-field>

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
            <v-btn color="blue darken-1" text @click="save()">Зберегти</v-btn>
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
          <v-toolbar-title>Розклад занять</v-toolbar-title>
          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>
          <v-spacer></v-spacer>
        <v-btn @click="dialog = true" color="primary" dark class="mb-2">Додати</v-btn>
        </v-toolbar>
      </template>

      <template v-slot:item.actions="{ item }">
        <v-btn icon @click="editItem(item)">
            <v-icon>mdi-pencil</v-icon>
        </v-btn>
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
      loading: true,
      dialog: false,
      editIndex: null,
      member: {
        name: '',
        optional_time: '',
        purpose: ''
      },
      headers: [
          { text: 'ПІБ', value: 'name' },
          { text: 'Мета заняття', value: 'purpose' },
          { text: 'Назначений час', value: 'optional_time' },
          { text: '', value: 'actions', sortable: false, align: 'right' },
      ],
      data: []
    }),

  created() {
    this.getData();
  },

    methods: {
        getData() {
          axios.get('/api/schedule')
            .then((response) => {
              this.data = response.data;
              this.loading = false;
            })
        },
        deleteItem(item) {
          axios.delete('/api/schedule/'+item.id)
            .then((response) => {
              const index = this.data.indexOf(item)
              this.data.splice(index, 1)
            })
        },
        addToSchedule() {
          axios.post('/api/schedule', this.member)
            .then((response) => {
                this.dialog = !this.dialog;
                this.data.push(response.data)
            })
        },
        editItem(item) {
          this.dialog = !this.dialog;
          Object.assign(this.member, item);
          this.editIndex = this.data.indexOf(item);
        },
        save() {
          axios.post('/api/schedule/'+this.member.id, this.member)
            .then((response) => {
                this.dialog = !this.dialog;
                this.getData();
            })
        }
    }
  }
</script>