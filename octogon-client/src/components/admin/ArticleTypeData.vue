<template>
  <div>
    <h1>Edit Article Type</h1>
    <div>
      <div>
        Name <input type="text" v-model="articleType.name" placeholder="name" />
      </div>
      <div>
        Description <input type="text" v-model="articleType.description" placeholder="description" />
      </div>
    </div>
    <div>
      {{ errorMessage }}
    </div>
    <div>
      <button v-on:click="saveArticleType">Save</button>
      <button v-on:click="cancel">Cancel</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "ArticleTypeData",
  data() {
    return {
      articleType: {
        name: "",
        description: ""
      },
      errorMessage: "Possible error message"
    }
  },
  methods: {
    saveArticleType() {
      console.log("Save the article type ...");
    },
    cancel() {
      console.log("Cancel ...");
      this.$router.push({name: "ArticleTypeList"});
    }
  }
}
</script>

<style>
</style>

