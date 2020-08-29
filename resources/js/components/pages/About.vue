<template>
  <v-container class="text-center" fluid>
    <v-row>
      <v-col>
        <AboutApp />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import AboutApp from '../parts/AboutApp.vue';

export default {
  components: {
    AboutApp,
  },
};
</script>
