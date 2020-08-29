<template>
  <v-container class="text-center" fluid>
    <v-row>
      <v-col>
        <AboutApp />
        <SnsShare />
        <div class="mb-4"></div>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AboutApp from '../parts/AboutApp.vue';
import SnsShare from '../parts/SnsShare.vue';

export default {
  components: {
    AboutApp,
    SnsShare,
  },
};
</script>
