<template>
  <div>
    <router-link :to="{name: 'ArticleData'}">Back to article</router-link>
    <h1>Authorship Data</h1>
    <div class="article-title">
      {{ article.title }}
    </div>
    <div>
      <div v-for="contributor in contributors" v-bind:key="contributor.id" class="contributor-item">
        <span>{{ contributor.firstName }} {{ contributor.familyName }}</span>
        <span><a href="#" @click="selectContributor(contributor.id)">Select</a></span>
      </div>
    </div>
    <div> 
      <router-link :to="{name: 'ContributorData'}" tag="button">Create a new contributor</router-link>
    </div>
    <div>
      <div class="input-field">
        <span class="field-name">First name</span>
        <input type="text" v-model="contributor.firstName" placeholder="first name" />
      </div>
      <div class="input-field">
        <span class="field-name">Family name</span>
        <input type="text" v-model="contributor.familyName" placeholder="family name" />
      </div>
      <div class="input-field">
        <span class="field-name">Email</span>
        <input type="text" v-model="contributor.email" placeholder="email" />
      </div>
      <div class="input-field">
        <span class="field-name">Affiliation</span>
        <input type="text" v-model="contributor.affiliation" placeholder="affiliation" />
      </div>
    </div>
    <div class="error-message">
      {{ errorMessage }}
    </div>
    <div>
      <button @click="addAuthorship">Add new authorship</button>
    </div>
    <router-link :to="{name: 'ArticleData'}">Back to article</router-link>
  </div>
</template>

<script>
export default {
  name: "AuthorshipData",
  data() {
    return {
      article: {
        id: 1,
        title: "Sample Title"
      },
      contributors: [
        {
          id: 1,
          firstName: "First",
          familyName: "Contributor"
        },
        {
          id: 2,
          firstName: "Second",
          familyName: "Contributor"
        },
        {
          id: 3,
          firstName: "Third",
          familyName: "Contributor"
        }
      ],
      contributor: {
        firstName: "",
        familyName: "",
        affiliation: "",
        email: ""
      },
      errorMessage: "Possible error message"
    }
  },
  methods: {
    selectContributor(contributorId) {
      console.log("Select contributor " + contributorId);
    },
    addAuthorship() {
      console.log("Add authorship ...");
    }
  }
}
</script>

<style>
div.contributor-item {
  padding: 10px;
  background-color: #FFF8F8;
  margin-bottom: 12px;
}

div.contributor-item span:nth-child(1) {
  width: 600px;
  display: inline-block;
}
</style>

