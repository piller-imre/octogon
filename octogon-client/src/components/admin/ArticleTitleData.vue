<template>
  <div>
    <h1>Article Title and Abstract</h1>
    <div class="article-volume">
    Volume {{ article.volume.volume }}, Number {{ article.volume.number }}, Year {{ article.volume.year }}
    </div>
    <div class="input-field">
      <span class="field-name">Title</span>
      <input type="text" v-model="article.title" placeholder="title" />
    </div>
    <div class="input-field">
      <span class="field-name">Abstract</span>
      <input type="text" v-model="article.abstract" placeholder="abstract" />
    </div>
    <button @click="renderAbstract">Render abstract</button>
    <div class="error-message">
      {{ errorMessage }}
    </div>
    <div>
      <button v-on:click="saveArticleTitleData">Save</button>
      <button v-on:click="cancel">Cancel</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "ArticleTitleData",
  data() {
    return {
      article: {
        id: 1,
        volume: {
          id: 1,
          volume: 1,
          number: 2,
          year: 2000
        },
        title: "",
        abstract: ""
      },
      errorMessage: "Possible error message"
    }
  },
  methods: {
    renderAbstract() {
      console.log("Render abstract ...");
    },
    saveArticleTitleData() {
      console.log("Save article title data ...");
    },
    cancel() {
      console.log("Cancel");
      this.$router.push({name: "ArticleData"});
    }
  }
}
</script>

<style>
</style>

