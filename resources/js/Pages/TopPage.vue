<template>
  <v-container>
    <v-row align="center">
      <v-col class="d-flex" cols="12" sm="6">
        <v-select :items="older" filled label="なんさい"></v-select>
      </v-col>
    </v-row>

    <v-row align="center">
      <v-col class="d-flex" cols="12" sm="6">
        <v-switch v-model="teppan" :label="`鉄板の遊び: ${teppan.toString()}`"></v-switch>
      </v-col>
    </v-row>

    <v-row class="d-flex justify-center">
      <v-col class="d-flex" cols="12" sm="6">
        <v-btn color="accent">
          <router-link to="/playindex">遊びを選ぶ</router-link>
        </v-btn>
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    older: ["0", "1", "2", "3", "4", "5", "6"],
    teppan: false
  }),
  mounted() {}
};
</script>
