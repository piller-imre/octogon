<template>
  <div id="app">
    <div class="banner">
      Octogon
    </div>
    <div class="side-menu">
      <!-- TODO: Use the div as the link! -->
      <div class="menu-item">
        <router-link :to="{name: 'Home'}">Home (testing)</router-link>
      </div>
      <div class="menu-item">
        <router-link :to="{name: 'VolumeList'}">Volumes</router-link>
      </div>
      <div class="menu-item">
        <router-link :to="{name: 'ContributorList'}">Contributors</router-link>
      </div>
      <div class="menu-item">
        <router-link :to="{name: 'EditorialBoardData'}">Editorial Board</router-link>
      </div>
      <div class="menu-item">
        <router-link :to="{name: 'ArticleTypeList'}">Article Types</router-link>
      </div>
      <div class="menu-item">
        <router-link :to="{name: 'PostList'}">Posts</router-link>
      </div>
      <div class="menu-item">
        <router-link :to="{name: 'FileList'}">Files</router-link>
      </div>
      <div class="menu-item">
        <router-link :to="{name: 'RuleData'}">Rules</router-link>
      </div>
      <div class="menu-item">
        <router-link :to="{name: 'ContactData'}">Contact</router-link>
      </div>
    </div>
    <div class="content">
      <router-view :key="$route.fullPath"></router-view>
    </div>
  </div>
</template>

<script>
export default {
  name: 'App'
}
</script>

<style>
body {
  background-image: url('assets/gradient.png');
  background-repeat: repeat-x;
  background-color: #222222;
}

#app {
  width: 950px;
  margin-left: auto;
  margin-right: auto;
  margin-top: 40px;
  background-color: #740000;
}

div.banner {
  height: 100px;
}

div.side-menu {
  width: 200px;
  float: left;
}

div.content {
  background-color: white;
  padding: 24px;
  margin-left: 200px;
  min-height: 300px;
}

div.content h1 {
  margin-top: 0px;
}

div.menu-item {
  background-image: url('assets/inactiveItem.png');
  height: 26px;
  padding-left: 20px;
  padding-top: 10px;
  margin-bottom: 4px;
}

div.menu-item:hover {
  background-image: url('assets/focusedItem.png');
}

div.menu-item a {
  color: white;
  text-decoration: none;
}

button {
  background-color: #994545;
  color: white;
  border: solid black 1px;
  padding: 10px;
  margin-right: 10px;
  margin-bottom: 10px;
}

button:hover {
  background-color: #BB8282;
}

select {
  background-color: #994545;
  color: white;
  border: solid black 1px;
  padding: 10px;
  margin-right: 10px;
  margin-bottom: 10px;
}

input {
  background-color: #FFF0F0;
  border: solid #BB8282 1px;
  padding: 10px;
}

textarea {
  width: 97%;
  background-color: #FFF0F0;
  border: solid #BB8282 1px;
  padding: 10px;
}

div.list-item {
  padding: 10px;
  background-color: #FFF8F8;
  margin-bottom: 12px;
  border: solid #CCCCCC 1px; 
}

div.list-item span:nth-child(1) {
  display: inline-block;
  width: 555px;
}

div.list-item span:nth-child(2) {
  display: inline-block;
  margin-right: 10px;
}

div.list-item span:nth-child(3) {
  display: inline-block;
}

div.article-title {
  background-color: #FFF0F0;
  padding: 20px;
  margin-bottom: 20px;
  border: solid #CCCCCC 1px;
}

div.article-abstract {
  background-color: #FFF0F0;
  padding: 20px;
  margin-bottom: 20px;
  border: solid #CCCCCC 1px;
}

div.article-volume {
  background-color: #FFF0F0;
  padding: 20px;
  margin-bottom: 20px;
  border: solid #CCCCCC 1px;
}

div.input-field {
  margin-bottom: 10px;
}

div.input-field input {
  width: 580px;
}

span.field-name {
  display: inline-block;
  width: 100px;
}

div.error-message {
  background-color: #FFFFAA;
  color: red;
  border: solid red 1px;
  padding: 10px;
  margin-bottom: 20px;
}

</style>
