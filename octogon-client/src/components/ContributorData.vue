<template>
  <div>
    <h1>Edit Contributor</h1>
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
      <button v-on:click="saveContributor">Save</button>
      <button v-on:click="cancel">Cancel</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContributorData",
  data() {
    return {
      contributor: {
        firstName: "",
        familyName: "",
        email: "",
        affiliation: ""
      },
      errorMessage: "Possible error message"
    }
  },
  methods: {
    saveContributor() {
      console.log("Save contributor ...");
    },
    cancel() {
      console.log("Cancel ...");
      this.$router.go(-1);
    }
  }
}
</script>

<style>
</style>

