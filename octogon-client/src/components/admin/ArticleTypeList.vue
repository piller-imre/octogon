<template>
  <div>
    <h1>Article Types</h1>
    <div>
      <router-link :to="{name: 'ArticleTypeData'}" tag="button">Create new article type</router-link>
    </div>
    <div>
      <div v-for="articleType in articleTypes" v-bind:key="articleType.id">
        {{ articleType.name }}
        <router-link :to="{name: 'ArticleTypeData'}">Edit</router-link>
        <a href="#" @click="removeArticleType(articleType.id)">Remove</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ArticleTypeList",
  data() {
    return {
      articleTypes: [
        {
          id: 1,
          name: "research"
        },
        {
          id: 2,
          name: "competition"
        },
        {
          id: 3,
          name: "solutions"
        }
      ]
    }
  },
  methods: {
    removeArticleType(articleTypeId) {
      console.log("Remove article type " + articleTypeId);
    }
  }
}
</script>

<style>
</style>

