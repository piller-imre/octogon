<template>
  <div>
    <h1>Contributors</h1>
    <div>
      <div>
        <input type="text" v-model="filterExpression" placeholder="filter expression" />
        <button @click="findContributors">Find</button>
      </div>
      <div>
        <router-link :to="{name: 'ContributorData'}" tag="button">Create new contributor</router-link>
      </div>
      <div>
        <div v-for="contributor in contributors" v-bind:key="contributor.id" class="list-item">
          <span>{{ contributor.firstName }} {{ contributor.familyName }}</span>
          <span><router-link :to="{name: 'ContributorData'}">Edit</router-link></span>
          <span><a href="#" @click="removeContributor(contributor.id)">Remove</a></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContributorList",
  data() {
    return {
      filterExpression: "",
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
      ]
    }
  },
  methods: {
    findContributors() {
      console.log("Find contributors ...");
    },
    removeContributor(contributorId) {
      console.log("Remove contributor " + contributorId);
    }
  }
}
</script>

<style>
</style>

