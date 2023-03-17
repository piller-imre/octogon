<template>
  <div>
    <h1>Edit the Editorial Board</h1>
    <div>
      <div>
        <input type="text" v-model="filterExpression" placeholder="filter expression" />
        <button @click="findContributors">Find</button>
      </div>
      <div>
        <div v-for="contributor in contributors" v-bind:key="contributor.id" class="list-item">
          <span>{{ contributor.firstName }} {{ contributor.familyName }}</span>
          <span><a href="#" @click="addContributor(contributor.id)">Add</a></span>
        </div>
      </div>
      <div>
        <router-link :to="{name: 'ContributorData'}" tag="button">Create new contributor</router-link>
      </div>
      <div>
        <div v-for="editor in editorialBoard" v-bind:key="editor.id" class="editorial-board-item">
          <span class="editor-name">{{ editor.firstName }} {{ editor.familyName }}</span>
          <span class="editor-item-action"><router-link :to="{name: 'ContributorData'}">Edit</router-link></span>
          <span class="editor-item-action"><a href="#" @click="removeEditor(editor.id)">Remove</a></span>
          <span class="editor-item-action"><a href="#" @click="moveEditorUp(editor.id)">Up</a></span>
          <span class="editor-item-action"><a href="#" @click="moveEditorDown(editor.id)">Down</a></span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "EditorialBoardData",
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
      ],
      editorialBoard: [
        {
          id: 4,
          firstName: "Editor",
          familyName: "1"
        },
        {
          id: 5,
          firstName: "Editor",
          familyName: "2"
        },
        {
          id: 6,
          firstName: "Editor",
          familyName: "3"
        }
      ]
    }
  },
  methods: {
    findContributors() {
      console.log("Find contributors ...");
    },
    addContributor(contributorId) {
      console.log("Add contributor " + contributorId);
    },
    removeEditor(editorId) {
      console.log("Remove editor " + editorId + " from the Editorial Board");
    },
    moveEditorUp(editorId) {
      console.log("Move editor " + editorId + " up ...");
    },
    moveEditorDown(editorId) {
      console.log("Move editor " + editorId + " down ...");
    }
  }
}
</script>

<style>
div.editorial-board-item {
  padding: 10px;
  background-color: #FFF8F8;
  margin-bottom: 12px;
  border: solid #CCCCCC 1px; 
}

span.editor-name {
  display: inline-block;
  width: 450px;
}

span.editor-item-action {
  display: inline-block;
  padding-left: 10px;
  padding-right: 10px;
}
</style>

