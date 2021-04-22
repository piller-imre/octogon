<template>
  <div>
    <h1>Editorial Board</h1>
    <div>
      <div v-for="editor in editorialBoard" v-bind:key="editor.id">
        {{ editor.firstName }}
        {{ editor.familyName }}
        {{ editor.affiliation }}
        {{ editor.email }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "EditorialBoard",
  data() {
    return {
      editorialBoard: [
        {
          id: 4,
          firstName: "Editor",
          familyName: "1",
          affiliation: "affiliation 1",
          email: "editor_1@mail.com"
        },
        {
          id: 5,
          firstName: "Editor",
          familyName: "2",
          affiliation: "affiliation 2",
          email: "editor_2@mail.com"
        },
        {
          id: 6,
          firstName: "Editor",
          familyName: "3",
          affiliation: "affiliation 3",
          email: "editor_3@mail.com"
        }
      ]
    }
  },
  methods: {
  }
}
</script>

<style>
</style>

