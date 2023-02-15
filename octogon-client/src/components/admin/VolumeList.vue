<template>
  <div>
    <h1>Volumes</h1>
    <div>
      <router-link :to="{name: 'VolumeData'}" tag="button">New volume</router-link>
    </div>
    <div>
      <div v-for="volume in volumes" v-bind:key="volume.id" class="volume-item">
        <span>
          <router-link :to="{name: 'VolumeContent'}">
            Volume {{ volume.volume }}, Number {{ volume.number }}, Year {{ volume.year }}
          </router-link>
        </span>
        <span>
          <router-link :to="{name: 'VolumeData'}">Edit</router-link>
        </span>
        <span>
          <a href="#" @click="removeVolume(volume.id)">Remove</a>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "VolumeData",
  data() {
    return {
      volumes: [
        {
          id: 1,
          volume: 1,
          number: 1,
          year: 2000
        },
        {
          id: 2,
          volume: 1,
          number: 2,
          year: 2000
        },
        {
          id: 3,
          volume: 1,
          number: 3,
          year: 2001
        }
      ]
    }
  },
  methods: {
    removeVolume(volumeId) {
      console.log("Remove volume " + volumeId);
    }
  }
}
</script>

<style>
div.volume-item {
  padding: 10px;
  background-color: #FFF8F8;
  margin-bottom: 12px;
  border: solid #CCCCCC 1px;
}

div.volume-item span:nth-child(1) {
  display: inline-block;
  width: 550px;
}

div.volume-item span:nth-child(2) {
  display: inline-block;
  margin-right: 10px;
}

div.volume-item span:nth-child(3) {
  display: inline-block;
}
</style>

