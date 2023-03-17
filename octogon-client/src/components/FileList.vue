<template>
  <div>
    <h1>Files</h1>
    <div>
      <button>Upload a new file</button>
    </div>
    <div>
      <div v-for="file in files" v-bind:key="file.name" class="list-item">
        <span>
          <a href="">{{ file.name }}</a>
          ({{ file.uploadDate }})
        </span>
        <span><a href="#" @click="removeFile(file.name)">Remove</a></span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FileList",
  data() {
    return {
      files: [
        {
          name: "photo.png",
          uploadDate: "2020.10.12 08:30"
        },
        {
          name: "conference_call_2023.pdf",
          uploadDate: "2021.04.15 10:50"
        }
      ]
    }
  },
  methods: {
    removeFile(name) {
      console.log("Remove file " + name);
    }
  }
}
</script>

<style>
</style>

