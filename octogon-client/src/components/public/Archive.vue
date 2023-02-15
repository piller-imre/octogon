<template>
  <div>
    <h1>Archive</h1>
    <div>
      <div v-for="volume in volumes" v-bind:key="volume.id">
        {{ volume.volume }} {{ volume.number }} {{ volume.year }}
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Archive",
  data() {
    return {
      volumes: [
        {
          id: 1,
          volume: 1,
          number: 1,
          year: 2000,
          coverImage: ""
        },
        {
          id: 2,
          volume: 1,
          number: 2,
          year: 2000,
          coverImage: ""
        },
        {
          id: 3,
          volume: 1,
          number: 3,
          year: 2001,
          coverImage: ""
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

