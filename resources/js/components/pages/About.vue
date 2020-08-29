<template>
  <v-container class="text-center" fluid>
    <v-row>
      <v-col>
        <AboutApp />
        <ShareApp />
        <div class="mb-4"></div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AboutApp from '../parts/AboutApp.vue';
import ShareApp from '../parts/ShareApp.vue';

export default {
  components: {
    AboutApp,
    ShareApp,
  },
};
</script>
