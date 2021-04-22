<template>
  <div>
    <router-link :to="{name: 'VolumeContent'}">Back to volume</router-link>
    <h1>Article</h1>
    <div>
    Volume {{ article.volume.volume }}, Number {{ article.volume.number }}, Year {{ article.volume.year }}
    </div>
    <div>
      <router-link :to="{name: 'ArticleTitleData'}" tag="button">Edit title and abstract</router-link>
    </div>
    <div>
      {{ article.title }}
    </div>
    <div>
      {{ article.abstract }}
    </div>
    Authors
    <div>
      <div v-for="author in article.authors" v-bind:key="author.id">
        {{ author.firstName }} {{ author.familyName }}
        <router-link :to="{name: 'ContributorData'}">Edit</router-link>
        <a href="#" @click="removeAuthor(author.id)">Remove</a>
        <a href="#" @click="moveAuthorUp(author.id)">Up</a>
        <a href="#" @click="moveAuthorDown(author.id)">Down</a>
      </div>
    </div>
    <div>
      <router-link :to="{name: 'AuthorshipData'}" tag="button">Add a new authorship</router-link>
    </div>
    <div>
      Article file: ...
    </div>
    <div>
      Pages
      <input type="text" v-model="article.pages.from" placeholder="from" />
      <input type="text" v-model="article.pages.to" placeholder="to" />
      <button @click="savePageRange">Save page range</button>
    </div>
    <router-link :to="{name: 'VolumeContent'}">Back to volume</router-link>
  </div>
</template>

<script>
export default {
  name: "ArticleData",
  data() {
    return {
      article: {
        volume: {
          id: 1,
          volume: 1,
          number: 2,
          year: 2000
        },
        title: "Sample title",
        abstract: "",
        authors: [
          {
            id: 1,
            firstName: "First",
            familyName: "Family"
          },
          {
            id: 2,
            firstName: "Second",
            familyName: "Family"
          }
        ],
        pages: {
          from: 10,
          to: 20
        }
      }
    }
  },
  methods: {
    removeAuthor(authorId) {
      console.log("Remove author " + authorId);
    },
    moveAuthorUp(authorId) {
      console.log("Move author " + authorId + " up");
    },
    moveAuthorDown(authorId) {
      console.log("Move author " + authorId + " down");
    },
    savePageRange() {
      console.log("Save page range ...");
    }
  }
}
</script>

<style>
</style>

