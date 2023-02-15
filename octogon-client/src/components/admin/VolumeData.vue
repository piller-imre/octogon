<template>
  <div>
    <h1>Edit Volume</h1>
    <div>
      <div class="input-field">
        <span class="field-name">Volume</span>
        <input type="text" v-model="volume.volume" placeholder="volume" />
      </div>
      <div class="input-field">
        <span class="field-name">Number</span>
        <input type="text" v-model="volume.number" placeholder="number" />
      </div>
      <div class="input-field">
        <span class="field-name">Year</span>
        <input type="text" v-model="volume.year" placeholder="year" />
      </div>
      <div class="input-field">
        <span class="field-name">Month</span>
        <input type="text" v-model="volume.month" placeholder="month" />
      </div>
      <div class="input-field">
        <span class="field-name">Cover image</span>
        <input type="text" v-model="volume.coverImage" placeholder="cover image" />
      </div>
      <div class="input-field">
        <span class="field-name">Visible?</span>
        <input type="checkbox" id="visibility-checkbox" v-model="volume.isVisible">
        <label for="visibility-checkbox">{{ volume.isVisible}}</label>
      </div>
      <div class="error-message">
        {{ errorMessage }}
      </div>
      <div>
        <button v-on:click="saveVolume">Save</button>
        <button v-on:click="cancel">Cancel</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "VolumeData",
  data() {
    return {
      volume: {
        id: 0,
        volume: 0,
        number: 0,
        year: 0,
        month: 0,
        coverImage: "",
        isVisible: true
      },
      errorMessage: "Possible error message"
    }
  },
  methods: {
    saveVolume() {
      console.log("Save the volume ...");
    },
    cancel() {
      console.log("Cancel ...");
      this.$router.push({name: "VolumeList"});
    }
  }
}
</script>

<style>
</style>

