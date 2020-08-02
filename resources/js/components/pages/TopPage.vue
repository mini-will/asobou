<template>
  <v-container>
    <!-- 検索設定UI -->
    <v-row justify="center" no-gutters class="mt-4">
      <v-col class="d-flex py-4" cols="12" sm="3">
        <!-- このページを参考にv-selectを実装
        https://codepen.io/fromarm4/pen/xzMyKv?__cf_chl_jschl_tk__=56a2537eb510bd440f1403551a576f416318bc3a-1592632997-0-AdjKfvk3_y3U-R4SenemIpCy7Gv9es0L45AMuMEf0PzYxftlNUoilG4_QiNgVuJSWk_OJUR-ejfv801nn1nnwI67QNA0c61hWNG3QjcI5Civ6TosA-8UlBmgLshOO2zaalokEqPAQh0Os1LsLiBrmr0aBXc-9mXmbJUO83hIEUGDF_3CGkDmNMF3tUtu8HL1Edl7bXoDIekyxD63nJYhM8GkWEp1MYr6xwt4nrAw2c5JL52LDciDob-W20FTQb57SXYOrLycpjFe08PMMdfvGtjd8PvOS_KNoZxHEFlarAsRP3L2jeZkB3guHlUAA0yU-zzEbGsPpkEFkwI9PTZ5gKo37DwGVNWJCkN98YIZNrTs-->
        <v-select
          label="なんさい"
          @input="updateValue($event, 'activePlayOld')"
          :items="playOld"
          :value="$store.state.form.activePlayOld"
          dense
        ></v-select>
      </v-col>
      <!-- <p>{{ $store.state.form.activePlayOld }}</p> -->

      <!-- TODO:トグルボタンとvuex -->
      <!-- <v-col class="d-flex" cols="12" sm="6">
        <v-switch
          label="鉄板の遊び"
          @input="updateValue($event, 'activeTeppan')"
          :items="teppan"
          :value="$store.state.form.activeTeppan"
          dense
        ></v-switch>
      </v-col>-->
      <!-- <v-switch v-model="teppan" :label="`鉄板の遊び`"></v-switch> -->
    </v-row>

    <v-row justify="center" align-content="center">
      <v-col class="mt-2" cols="12">
        <v-btn color="secondary">シャッフル</v-btn>
      </v-col>
    </v-row>

    <!-- 遊びを表示 -->
    <h2 class="mt-10">あそびをえらんでね</h2>
    <div v-if="!loading">
      <v-row>
        <v-col v-for="(playcard, index) in playcards" :key="index" cols="12" sm="6" md="4" lg="3">
          <v-card class="mb-4">
            <v-responsive :aspect-ratio="16 / 9">
              <router-link :to="{ name: 'PlayInfo', params: { id: playcard.id } }">
                <v-img
                  :src="playcard.image_url"
                  class="white--text align-end"
                  gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                  height="200px"
                >
                  <v-card-title v-text="playcard.display_name" class="headline font-weight-bold"></v-card-title>
                </v-img>
              </router-link>

              <v-card-actions>
                <p>{{playcard.category}}</p>
                <v-spacer></v-spacer>
                <!-- <v-btn icon v-on:click="color_switch(playcard.id)">
                  <v-icon v-if="isActiveIn === false">mdi-heart</v-icon>
                  <v-icon v-else color="pink">mdi-heart</v-icon>
                </v-btn>-->
                <v-btn @click.stop="switchDialog(playcard.id, playcard.category, index)">ほかの</v-btn>
              </v-card-actions>
            </v-responsive>
          </v-card>
        </v-col>
      </v-row>
    </div>

    <div v-else>Loading...</div>
    <!-- ■ダイアログ -->
    <!-- 子コンポーネントを読み込んだ時点で、created, mountedは呼び出される -->
    <DialogRandom
      :dialogOn="dialogOnOff"
      :play-id="dialogPlayId"
      :play-category="dialogCategory"
      :play-index="dialogIndex"
      v-on:dialog-change="switchMainPlay"
    />
  </v-container>
</template>

<script>
import { mapState } from 'vuex';
import DialogRandom from '../parts/DialogRandom.vue';

export default {
  components: {
    DialogRandom,
  },

  data() {
    return {
      loading: false,
      isActiveIn: false,
      playLiked: [],

      playcards: [],

      dialogOnOff: false,
      dialogPlayId: 0,
      dialogCategory: '',
      dialogIndex: 0,
    };
  },
  created() {
    this.getPlayCard('origami');
    this.getPlayCard('drawing');
    this.getPlayCard('exercise');
    this.getPlayCard('snack');
    this.getPlayCard('game');
  },
  mounted() {},
  computed: {
    store() {
      return this.$store.state;
    },
    ...mapState(['playOld']),
    ...mapState(['form.activePlayOld']),
    ...mapState(['teppan']),
    ...mapState(['form.activeTeppan']),
  },
  methods: {
    getPlayCard: function (category) {
      this.loading = true;
      // eslint-disable-next-line no-undef
      axios
        .get(`/api/playproduct?category=${category}&random=1`)
        .then((response) => {
          // this.playcards = response.data;
          this.playcards.push(response.data[0]);
          this.loading = false;
        });
    },
    getPlayProductById: function (playId) {
      // eslint-disable-next-line no-undef
      axios.get(`/api/playproduct/${playId}`).then((response) => {
        return response.data;
      });
    },
    color_switch(playId) {
      this.isActiveIn = !this.isActiveIn;
      this.playLiked.splice(0, 1, {
        id: 1,
        user: 'testUser',
        playId: playId,
        liked: this.isActiveIn,
        display: 'show',
      });
    },
    updateValue(vals, key_name) {
      this.$store.commit('updateValue', { vals, key_name });
    },
    // Dialog on(true)にしてダイアログを表示する
    switchDialog: function (playId, playCategory, playIndex) {
      console.log(
        'switchDialog: playID ' +
          playId +
          ', playCategory ' +
          playCategory +
          ', playIndex ' +
          playIndex
      );

      this.dialogOnOff = !this.dialogOnOff;
      this.dialogPlayId = Number(playId);
      this.dialogCategory = String(playCategory);
      this.dialogIndex = Number(playIndex);
    },
    // DialogRandom component からemitで呼び出す処理
    switchMainPlay: function (playId, playCategory, playIndex) {
      console.log(
        'switchMainPlay: playID ' +
          playId +
          ', playCategory ' +
          playCategory +
          ', playIndex ' +
          playIndex
      );

      this.dialogOnOff = !this.dialogOnOff;
      this.dialogPlayId = Number(playId);
      this.dialogCategory = String(playCategory);
      this.dialogIndex = Number(playIndex);

      // ダイアログで遊びカードを選択したときはplayIDが取得できる
      if (typeof playId == 'number') {
        console.log('switchDialog: play入れ替え ' + playId);

        //ダイアログで選択した遊びをトップページに表示させる
        // eslint-disable-next-line no-undef
        axios.get(`/api/playproduct/${playId}`).then((response) => {
          this.playcards.splice(this.dialogIndex, 1, response.data);
        });
      }
    },
  },
};
</script>
