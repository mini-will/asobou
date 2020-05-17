<template>
    <v-app>
        <v-app-bar color="primary" dark app>
            <v-toolbar-title>Asobou</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn pr-4 color="accent">
                <router-link to="/">Home</router-link>
            </v-btn>
            <v-btn color="accent">
                <router-link to="/second">Second</router-link>
            </v-btn>
        </v-app-bar>

        <br />
        <br />
        <router-view></router-view>
    </v-app>
</template>
