<template>
  <div>
    <h1>Edit Contributor</h1>
    <div>
      <div>
        First name <input type="text" v-model="contributor.firstName" placeholder="first name" />
      </div>
      <div>
        Family name <input type="text" v-model="contributor.familyName" placeholder="family name" />
      </div>
      <div>
        Email <input type="text" v-model="contributor.email" placeholder="email" />
      </div>
      <div>
        Affiliation <input type="text" v-model="contributor.affiliation" placeholder="affiliation" />
      </div>
    </div>
    <div>
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

