<template>
  <div>
    <v-navigation-drawer
      v-model="drawer"
      :clipped="$vuetify.breakpoint.lgAndUp"
      app
    >
      <v-list dense>
        <template v-for="item in items">
          <v-list-item
            :key="item.text"
            link
            :to="item.url"
          >
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>
      </v-list>
    </v-navigation-drawer>
    <v-app-bar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      app
      color="darken-3"
      dark
    >
    <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
    <v-toolbar-title
      style="width: 300px"
      class="ml-0 pl-4"
    >
      <span class="hidden-sm-and-down">Admin Panel</span>
    </v-toolbar-title>
    <v-spacer />
    <v-btn icon to="/">
      <v-icon class="material-icons">language</v-icon>
    </v-btn>
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
            <v-btn icon>
                <v-icon v-on="on">person</v-icon>
            </v-btn>
        </template>
        <v-list>
            <v-list-item @click="exit">
                <v-list-item-title>Вихід</v-list-item-title>
            </v-list-item>
        </v-list>
      </v-menu>
    </v-app-bar>
  </div>
</template>

<script>
export default {
    data: () => ({
      drawer: null,
      items: [
        { icon: 'dashboard', text: 'Загальні налаштування', url: "/admin" },
        { icon: 'insert_photo', text: 'Фотогалерея', url: "/dashboard/photo" },
        { icon: 'movie', text: 'Відеогалерея', url: "/dashboard/video" },
        { icon: 'art_track', text: 'Новини', url: "/dashboard/news" },
        { icon: 'assignment_ind', text: 'Заявки', url: "/dashboard/applications" },
        { icon: 'assignment', text: 'Розклад занять', url: "/dashboard/schedule" },
      ],
      user: JSON.parse(localStorage.getItem('user'))
    }),
    created() {
    },
    methods: {
      exit() {
          localStorage.clear();
          location="/login";
      }
    }
}
</script>