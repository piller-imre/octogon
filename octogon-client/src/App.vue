<template>
  <div id="app">
    <div>
      <router-link :to="{name: 'Home'}">Home</router-link>
      <router-link :to="{name: 'Archive'}">Archive</router-link>
      <router-link :to="{name: 'Rules'}">Rules</router-link>
      <router-link :to="{name: 'EditorialBoard'}">Editorial Board</router-link>
      <router-link :to="{name: 'Contacts'}">Contacts</router-link>
    </div>
    <div>
      <router-view :key="$route.fullPath"></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App',
  methods: {
    isAdmin() {
      let adminPages = [
        'ProductListRoot',
        'ProductList',
        'EditProduct',
        'NewMainCategory',
        'NewSubCategory',
        'NewProduct'
      ];
      if (adminPages.includes(this.$route.name)) {
        return true;
      }
      else {
        return false;
      }
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
