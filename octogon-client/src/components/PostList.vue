<template>
  <div>
    <h1>Posts</h1>
    <div>
      <router-link :to="{name: 'PostData'}" tag="button">Create new post</router-link>
    </div>
    <div>
      <div v-for="post in posts" v-bind:key="post.id" class="list-item">
        <span>{{ post.uploadDate }}</span>
        <span><router-link :to="{name: 'PostData'}">Edit</router-link></span>
        <span><a href="#" @click="removePost(post.id)">Remove</a></span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "PostList",
  data() {
    return {
      posts: [
        {
          id: 1,
          content: "Third post",
          uploadDate: "2023.02.20"
        },
        {
          id: 2,
          content: "Second post",
          uploadDate: "2023.01.08"
        },
        {
          id: 3,
          content: "First post",
          uploadDate: "2023.10.12"
        }
      ]
    }
  },
  methods: {
    removePost(postId) {
      console.log("Remove post " + postId);
    }
  }
}
</script>

<style>
</style>

