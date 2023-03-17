<template>
  <div>
    <h1>Edit the Rules</h1>
    <div>
      <div class="input-field">
        <textarea v-model="rule.content" placeholder="Content"></textarea>
      </div>
    </div>
    <div v-if="errorMessage" class="error-message">
      {{ errorMessage }}
    </div>
    <div>
      <button v-on:click="saveRule">Save the Rule</button>
    </div>
  </div>
</template>

<script>
export default {
  name: "RuleData",
  data() {
    return {
      rule: {
        content: ""
      },
      errorMessage: ""
    }
  },
  methods: {
    saveRule() {
      console.log("Save the rule ...");
    }
  }
}
</script>

<style>
</style>

