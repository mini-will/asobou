<template>
  <v-app>
    <AppHeader />
    <AppFooter />
    <br />
    <br />
    <router-view></router-view>
  </v-app>
</template>

<script>
import AppHeader from './components/globals/AppHeader.vue';
import AppFooter from './components/globals/AppFooter.vue';

export default {
  name: 'App',

  components: {
    AppHeader,
    AppFooter,
  },
  data() {
    return {};
  },
};
</script>
