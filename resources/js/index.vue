<template>
  <v-app>
    <v-app-bar color="primary" dark app>
      <v-toolbar-title style="cursor: pointer" @click="$router.push('/', () => {})">Asobou</v-toolbar-title>
      <v-spacer></v-spacer>

      <v-btn color="accent" small>
        <router-link to="/playindex">PlayIndex</router-link>
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
