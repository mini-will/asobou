<template>
  <v-app>
    <v-app-bar color="primary" dark app>
      <v-toolbar-title>Vuetify</v-toolbar-title>
    </v-app-bar>

    <router-link to="/">Home</router-link>
    <router-link to="/second">Second</router-link>
    <router-view></router-view>
  </v-app>
</template>