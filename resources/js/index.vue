<template>
  <v-app>
    <v-app-bar color="deep-orange lighten-2" app>
      <v-toolbar-title
        style="cursor: pointer"
        @click="$router.push('/', () => {})"
        class="white--text"
      >Asobou</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn color="orange lighten-5" small>
        <router-link to="/playallitem">遊び一覧</router-link>
      </v-btn>
    </v-app-bar>

    <br />
    <br />
    <router-view></router-view>
  </v-app>
</template>

<script>
export default {
  name: "App",

  data: () => ({
    //
  })
};
</script>
