<template>
  <div>
    <h1>Login</h1>
    <div>
      <div class="input-field">
        <span class="field-name">E-mail</span>
        <input type="text" v-model="user.email" placeholder="email" />
      </div>
      <div class="input-field">
        <span class="field-name">Password</span>
        <input type="password" v-model="user.password" placeholder="password" />
      </div>
    </div>
    <div class="error-message">
      {{ errorMessage }}
    </div>
    <div>
      <button v-on:click="login">Sign in</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      user: {
        email: "",
        password: ""
      },
      errorMessage: "Possible error message"
    }
  },
  methods: {
    login() {
      console.log("Login ...");
    }
  }
}
</script>

<style>
</style>
