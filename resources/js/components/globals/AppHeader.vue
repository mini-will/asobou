<template>
  <header>
    <v-app-bar color="#FFA000" app>
      <v-app-bar-nav-icon @click="drawer = true" color="white"></v-app-bar-nav-icon>
      <v-toolbar-title
        style="cursor: pointer;"
        @click="$router.push('/', () => {})"
        class="white--text"
      >Asobiy</v-toolbar-title>

      <v-tabs>
        <v-tab
          v-for="(menuItem, index) in menuItems"
          :key="index"
          :to="menuItem.link"
          class="white--text"
        >{{ menuItem.name }}</v-tab>
      </v-tabs>

      <!-- <v-spacer></v-spacer>
      <v-btn icon>
        <v-icon>mdi-magnify</v-icon>
      </v-btn>-->
    </v-app-bar>

    <v-navigation-drawer v-model="drawer" absolute temporary>
      <v-list nav dense>
        <v-list-item-group>
          <v-list-item v-for="(menuItem, index) in menuItems" :key="index" :to="menuItem.link">
            <v-list-item-title>{{ menuItem.name }}</v-list-item-title>
          </v-list-item>
        </v-list-item-group>
      </v-list>
    </v-navigation-drawer>
  </header>
</template>

<script>
import constants from '../../common/constants';

export default {
  name: 'AppHeader',
  data() {
    return {
      drawer: false,
      menuItems: constants.menuItems,
    };
  },
};
</script>

<style lang="scss" scoped>
// TODO:スタイル読み込みをグローバルにしたい
@import '../../../sass/common/common.scss';

.v-toolbar__title {
  overflow: visible !important;
  margin-right: 50px !important;
}

// PCのときにハンバーガーメニューを非表示にする
.v-app-bar__nav-icon {
  @include display_pc {
    display: none !important;
  }
}

// PCのときのみタブメニューを表示する
.v-tabs {
  display: none;

  @include display_pc {
    display: block !important;
  }
}
</style>
