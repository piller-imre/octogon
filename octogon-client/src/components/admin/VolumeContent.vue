<template>
  <div>
    <router-link :to="{name: 'VolumeList'}">Back to volumes</router-link>
    <h1>Volume Content</h1>
    <div>
      <div>
        <router-link :to="{name: 'ArticleData'}" tag="button">Create new article</router-link>
      </div>
      <div>
        <div v-for="article in contents.articles" v-bind:key="article.id">
          <span v-for="author in article.authors" v-bind:key="author">{{ author }}, </span>
          : {{ article.title }}
          <router-link :to="{name: 'ArticleData'}">Edit</router-link>
          <a href="#" @click="removeArticle(article.id)">Remove</a>
        </div>
      </div>
    </div>
    <router-link :to="{name: 'VolumeList'}">Back to volumes</router-link>
  </div>
</template>

<script>
export default {
  name: "VolumeContent",
  data() {
    return {
      contents: {
        volume: {
          id: 0,
          volume: 0,
          number: 0,
          year: 0,
          month: 0,
          coverImage: "",
          isVisible: true
        },
        articles: [
          {
            id: 1,
            authors: [
              "First", "Second", "Third"
            ],
            title: "Title 1"
          },
          {
            id: 2,
            authors: [
              "Second", "Forth"
            ],
            title: "Title 2"
          }
        ]
      }
    }
  },
  methods: {
    removeArticle(articleId) {
      console.log("Remove article " + articleId);
    }
  }
}
</script>

<style>
</style>

