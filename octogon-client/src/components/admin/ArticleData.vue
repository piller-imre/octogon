<template>
  <div>
    <router-link :to="{name: 'VolumeContent'}">Back to volume</router-link>
    <h1>Article</h1>
    <div class="article-volume">
      Volume {{ article.volume.volume }}, Number {{ article.volume.number }}, Year {{ article.volume.year }}
    </div>
    <div class="article-title">
      {{ article.title }}
    </div>
    <div class="article-abstract">
      {{ article.abstract }}
    </div>
    <div>
      <router-link :to="{name: 'ArticleTitleData'}" tag="button">Edit title and abstract</router-link>
    </div>
    <h2>Authors</h2>
    <div>
      <div v-for="author in article.authors" v-bind:key="author.id" class="author-item">
        <span class="author-name">
        {{ author.firstName }} {{ author.familyName }}
        </span>
        <span class="author-item-action">
          <router-link :to="{name: 'ContributorData'}">Edit</router-link>
        </span>
        <span class="author-item-action">
          <a href="#" @click="removeAuthor(author.id)">Remove</a>
        </span>
        <span class="author-item-action">
          <a href="#" @click="moveAuthorUp(author.id)">Up</a>
        </span>
        <span class="author-item-action">
          <a href="#" @click="moveAuthorDown(author.id)">Down</a>
        </span>
      </div>
    </div>
    <div>
      <router-link :to="{name: 'AuthorshipData'}" tag="button">Add a new authorship</router-link>
    </div>
    <h2>Article file</h2>
    <div>
      <div>
        <a href="#">Sample_article_file.pdf</a>
      </div>
      <button>Upload article file</button>
    </div>
    <h2>Page numbers</h2>
    <div class="page-range">
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
        abstract: "Sample abstract",
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
div.author-item {
  padding: 10px;
  background-color: #FFF8F8;
  margin-bottom: 12px;
}

span.author-name {
  width: 430px;
  display: inline-block;
}

div.page-range {
  margin-bottom: 20px;
}

div.page-range input {
  width: 60px;
  text-align: center;
  margin-right: 20px;
}

span.author-item-action {
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
}
</style>

