<template>
  <div>
    <h1>Edit Contact Information</h1>
    <div>
      <div class="input-field">
        <textarea v-model="contact.content" placeholder="Content"></textarea>
      </div>
    </div>
    <div v-if="errorMessage" class="error-message">
      {{ errorMessage }}
    </div>
    <div>
      <button v-on:click="saveContact">Save the Contact Information</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "ContactData",
  data() {
    return {
      contact: {
        content: ""
      },
      errorMessage: ""
    }
  },
  methods: {
    saveContact() {
      console.log("Save the contact information ...");
    }
  }
}
</script>

<style>
</style>

