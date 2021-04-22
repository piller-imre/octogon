<template>
  <div>
    Home
    <div>
      <ul>
        <li>
          <router-link :to="{name: 'ArticleData'}">Article Data</router-link>
        </li>
        <li>
          <router-link :to="{name: 'ArticleList'}">Article List</router-link>
        </li>
        <li>
          <router-link :to="{name: 'ArticleTypeData'}">Article Type Data</router-link>
        </li>
        <li>
          <router-link :to="{name: 'ArticleTypeList'}">Article Type List</router-link>
        </li>
        <li>
          <router-link :to="{name: 'AuthorshipData'}">Authorship Data</router-link>
        </li>
        <li>
          <router-link :to="{name: 'ContributorData'}">Contributor Data</router-link>
        </li>
        <li>
          <router-link :to="{name: 'ContributorList'}">Contributor List</router-link>
        </li>
        <li>
          <router-link :to="{name: 'EditorialBoardData'}">Editorial Board Data</router-link>
        </li>
        <li>
          <router-link :to="{name: 'VolumeContent'}">Volume Content</router-link>
        </li>
        <li>
          <router-link :to="{name: 'VolumeData'}">Volume Data</router-link>
        </li>
        <li>
          <router-link :to="{name: 'VolumeList'}">Volume List</router-link>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
    }
  },
  methods: {
  }
}
</script>

<style>
</style>

