<template>
    <v-data-table
      :headers="headers"
      :loading="loading"
      :items="data"
      sort-by="calories"
      class="elevation-1"
    >
      <template v-slot:top>
        <v-toolbar flat color="white">
          <v-toolbar-title>Новини</v-toolbar-title>
          <v-divider
            class="mx-4"
            inset
            vertical
          ></v-divider>
          <v-spacer></v-spacer>
        <v-btn to="/admin/post-news" color="primary" dark class="mb-2">Додати новину</v-btn>
        </v-toolbar>
      </template>

      <template v-slot:item.actions="{ item }">
        <router-link style="text-decoration: none" :to="'/admin/edit-news/'+item.id">
          <v-icon
            small
            class="mr-2"
          >
            mdi-pencil
          </v-icon>
        </router-link>
        <v-icon
          small
          @click="deleteItem(item)"
        >
          mdi-delete
        </v-icon>
      </template>
    </v-data-table>
</template>

<script>
  export default {
    data: () => ({
      loading: true,
      headers: [
          { text: '#', align: 'start', value: 'id', width: "20px" },
          { text: 'Назва', value: 'title' },
          { text: 'Дата публікації', value: 'created_at' },
          { text: '', value: 'actions', sortable: false, align: 'right' },
      ],
      data: [],
    }),

  created() {
    this.getData();
  },

    methods: {
        getData() {
          axios.get('/api/news')
            .then((response) => {
              this.data = response.data;
              this.loading = false;
            })
        },
        deleteItem(item) {
          axios.delete('/api/news/'+item.id)
            .then((response) => {
              const index = this.data.indexOf(item)
              this.data.splice(index, 1)
            })
        },
    }
  }
</script>