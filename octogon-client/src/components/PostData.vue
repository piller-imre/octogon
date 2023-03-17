<template>
  <div>
    <h1>Edit the Post</h1>
    <div>
      <div class="input-field">
        <span class="field-name">Date</span>
        <input type="text" v-model="post.uploadDate" placeholder="2023.03.12" />
      </div>
      <div class="input-field">
        <textarea v-model="post.content" placeholder="Content"></textarea>
      </div>
    </div>
    <div v-if="errorMessage" class="error-message">
      {{ errorMessage }}
    </div>
    <div>
      <button v-on:click="savePost">Save the Post</button>
      <button v-on:click="cancel">Cancel</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostData",
  data() {
    return {
      post: {
        uploadDate: "",
        content: ""
      },
      errorMessage: ""
    }
  },
  methods: {
    savePost() {
      console.log("Save the post ...");
      if (this.checkPost()) {
        this.$router.push({name: "PostList"});
      }
    },
    cancel() {
      console.log("Cancel ...");
      this.$router.push({name: "PostList"});
    },
    checkPost() {
      if (this.post.uploadDate == "") {
        this.errorMessage = "The upload date is missing!";
        return false;
      }
      if (this.post.content == "") {
        this.errorMessage = "The content is missing!";
        return false;
      }
      return true;
    }
  }
}
</script>

<style>
</style>

