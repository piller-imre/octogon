<template>
  <div>
    <h1>Article Types</h1>
    <div>
      <router-link :to="{name: 'ArticleTypeData'}" tag="button">Create new article type</router-link>
    </div>
    <div>
      <div v-for="articleType in articleTypes" v-bind:key="articleType.id" class="article-type-item">
        <span>{{ articleType.name }}</span>
        <span><router-link :to="{name: 'ArticleTypeData'}">Edit</router-link></span>
        <span><a href="#" @click="removeArticleType(articleType.id)">Remove</a></span>
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
div.article-type-item {
  padding: 10px;
  background-color: #FFF8F8;
  margin-bottom: 12px;
  border: solid #CCCCCC 1px; 
}

div.article-type-item span:nth-child(1) {
  display: inline-block;
  width: 555px;
}

div.article-type-item span:nth-child(2) {
  display: inline-block;
  margin-right: 10px;
}

div.article-type-item span:nth-child(3) {
  display: inline-block;
}
</style>

