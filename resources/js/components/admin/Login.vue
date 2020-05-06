<template>
    <v-content>
      <v-container fluid class="my-8">
        <v-layout align-center justify-center>
          <v-flex xs12 sm8 md6>
            <v-card class="elevation-12">
              <v-toolbar color="primary" dark flat>
                <v-toolbar-title>Авторизація</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                <v-form ref="form" v-model="valid" lazy-validation>
                  <v-text-field
                    label="Email"
                    name="email"
                    v-model="email"
                    :rules="loginEmailRules"
                    prepend-icon="person"
                    type="text"
                  ></v-text-field>

                  <v-text-field
                    id="password"
                    label="Пароль"
                    name="password"
                    v-model="password"
                    :rules="loginPasswordRules"
                    prepend-icon="lock"
                    type="password"
                  ></v-text-field>
                </v-form>
              </v-card-text>
              <v-card-text class="pt-0">
                <v-alert v-if="error != ''" :value="true" type="error">{{ error }}</v-alert>
              </v-card-text>
              <v-card-actions>
                <v-btn :disabled="!valid || email == '' || password == ''" color="primary" :loading="loginLoading" @click="handleSubmit">Вхід</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </v-layout>
      </v-container>
    </v-content>
</template>
<script>
import validation from '../mixins/validation';
  export default {
    mixins: [validation],
    data(){
      return {
        email : "",
        password : "",
        error: "",
        valid: false,
        loginLoading: false
      }
    },
		created() {
			document.title = "Авторизація";
		},
    methods: {
      handleSubmit(e) {
        e.preventDefault();
        this.loginLoading = true;
        axios.post('/api/login', {
          email: this.email,
          password: this.password
        }).then(response => {
          localStorage.setItem('user', JSON.stringify(response.data.user));
          localStorage.setItem('jwt', response.data.success.token);
          if (localStorage.getItem('jwt') != null) {
            location="/admin";
          }
        }).catch(() => {
          this.error = "Помилка!";
          this.loginLoading = false;
        })
      }
    }
  }
</script>