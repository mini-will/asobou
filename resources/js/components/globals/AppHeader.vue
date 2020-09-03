<template>
  <header>
    <v-app-bar class="app-bar" app>
      <v-app-bar-nav-icon @click="drawer = true" color="#64BBB1"></v-app-bar-nav-icon>
      <v-toolbar-title style="cursor: pointer;" @click="$router.push('/', () => {})">Asobiy</v-toolbar-title>

      <v-tabs>
        <v-tab v-for="(menuItem, index) in menuItems" :key="index" :to="menuItem.link">
          <div class="v-tabs-text">
            <span class="header-icon material-icons pr-1">{{ menuItem.icon }}</span>
            {{ menuItem.name }}
          </div>
        </v-tab>
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
            <v-list-item-title>
              <div class="drawer-title">
                <span class="material-icons pr-1">{{ menuItem.icon }}</span>
                {{ menuItem.name }}
              </div>
            </v-list-item-title>
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

<style lang="css">
.v-toolbar {
  background: #ffefba; /* fallback for old browsers */
  background: -webkit-linear-gradient(
    to right,
    #ffffff,
    #ffefba
  ); /* Chrome 10-25, Safari 5.1-6 */
  background: linear-gradient(
    to right,
    #ffffff,
    #ffefba
  ); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.v-toolbar__title {
  color: #64bbb1;
  font-family: 'Kalam', cursive;
  font-size: 1.5rem !important;
}
.v-tabs-text {
  color: #64bbb1;
}
.drawer-title {
  color: #64bbb1;
}
.header-icon {
  vertical-align: middle;
}
.drawer-title span {
  vertical-align: middle;
}
</style>
