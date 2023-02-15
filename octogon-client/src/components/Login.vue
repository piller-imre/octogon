<template>
  <div>
    Login
    <input type="text" v-model="user.email" placeholder="email" />
    <input type="password" v-model="user.password" placeholder="password" />
    <button v-on:click="login">Sign in</button>
    <div>
      {{ errorMessage }}
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

