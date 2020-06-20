<template>
  <v-app>
    <AppHeader />
    <br />
    <br />
    <router-view></router-view>
  </v-app>
</template>

<script>
import AppHeader from "./components/AppHeader.vue";

export default {
  name: "App",

  components: {
    AppHeader
  },
  data() {
    return {};
  }
};
</script>

