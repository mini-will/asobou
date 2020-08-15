<template>
  <v-container color="#FFC107" class="text-center" fluid style="max-height: 100%;">
    <!-- <br />
    <v-btn color="primary">primary</v-btn>
    <v-btn color="secondary">secondary</v-btn>
    <v-btn color="accent">accent</v-btn>
    <br />
    <v-btn color="success">Success</v-btn>
    <v-btn color="error">Error</v-btn>
    <v-btn color="warning">Warning</v-btn>
    <v-btn color="info">Info</v-btn>
    <br />-->

    <div class="select-old-text">
      <h2 class="mt-10 grey--text text--darken-3">なんさいですか？</h2>
    </div>

    <div class="select-old-btn">
      <v-row style="height: 80px;" justify="center" align-content="center">
        <v-btn
          min-width="90"
          height="50"
          color="white subtitle-1"
          @click="switchSelectOld(0)"
          :class="{ 'red lighten-2 white--text font-weight-bold title': isActiveOldBtn0 }"
        >0さい</v-btn>
        <v-btn
          min-width="90"
          height="50"
          color="white subtitle-1"
          class="mx-4"
          @click="switchSelectOld(1)"
          :class="{  'red lighten-2 white--text font-weight-bold': isActiveOldBtn1 }"
        >1-2さい</v-btn>
        <v-btn
          min-width="90"
          height="50"
          color="white subtitle-1"
          @click="switchSelectOld(2)"
          :class="{  'red lighten-2 white--text font-weight-bold': isActiveOldBtn2 }"
        >3さい〜</v-btn>
      </v-row>
    </div>

    <!-- <v-row class="green lighten-4 my-4" justify="center" align-content="center">
      <v-btn color="white">シャッフル</v-btn>
    </v-row>-->

    <!-- <v-row class="yellow lighten-4" style="height: 100px;" justify="center" align-content="center">
      <v-col cols="4" sm="3" md="2" lg="1" v-for="n in 3" :key="n">
        <v-btn min-width="90" color="white">{{n}}</v-btn>
      </v-col>
    </v-row>-->

    <!-- 遊びを表示 -->
    <div class="select-play-text">
      <h2 class="mt-6 grey--text text--darken-3">あそびをえらんでね</h2>
    </div>
    <div v-if="!loading">
      <v-row>
        <v-col
          v-for="(playcard, index) in displayPlayItemState"
          :key="index"
          cols="12"
          sm="6"
          md="4"
          lg="3"
        >
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
                <v-btn
                  color="#4FC3F7"
                  class="white--text"
                  @click.stop="switchDialog(playcard.id, playcard.category, index)"
                >チェンジ</v-btn>
              </v-card-actions>
            </v-responsive>
          </v-card>
        </v-col>
      </v-row>
    </div>

    <div v-else>Loading...</div>

    <div>
      <v-row>
        <v-col>
          <h2 class="my-4 grey--text text--darken-3">簡単遊びって？</h2>
          <p class="mb-10">毎日遊びを選ぶのも大変です。同じ遊びばかりでは飽きてしまいますよね。</p>
        </v-col>
      </v-row>
    </div>

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
import { mapState, mapMutations } from 'vuex';
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

      // 年齢を選択するボタンの制御
      isActiveOldBtn0: false,
      isActiveOldBtn1: false,
      isActiveOldBtn2: false,
    };
  },
  created() {
    this.getInitialPlayData();
  },
  mounted() {},
  computed: {
    store() {
      return this.$store.state;
    },
    ...mapState(['playOldState', 'displayPlayItemState']),
  },
  methods: {
    ...mapMutations(['setOld', 'setDisplayPlayItem', 'spliceDisplayPlayItem']),
    getPlayCard: function (category) {
      this.loading = true;
      // eslint-disable-next-line no-undef
      axios
        .get(`/api/playproduct?category=${category}&random=1`)
        .then((response) => {
          // this.playcards.push(response.data[0]);
          this.setDisplayPlayItem({ response: response });
          // console.log('displayPlayItemState:' + this.displayPlayItemState);
          this.loading = false;
        });
    },
    getInitialPlayData: function () {
      // state playItemにデータが無いときだけ初回データを取得する
      if (this.displayPlayItemState.length === 0) {
        console.log(
          'displayPlayItemState is null.' + this.displayPlayItemState
        );

        this.getPlayCard('singing');
        this.getPlayCard('origami');
        this.getPlayCard('drawing');
        this.getPlayCard('exercise');
        this.getPlayCard('snack');
        this.getPlayCard('game');
      }
    },
    // getPlayProductById: function (playId) {
    //   axios.get(`/api/playproduct/${playId}`).then((response) => {
    //     return response.data;
    //   });
    // },
    // color_switch(playId) {
    //   this.isActiveIn = !this.isActiveIn;
    //   this.playLiked.splice(0, 1, {
    //     id: 1,
    //     user: 'testUser',
    //     playId: playId,
    //     liked: this.isActiveIn,
    //     display: 'show',
    //   });
    // },
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
          // this.playcards.splice(this.dialogIndex, 1, response.data);
          this.spliceDisplayPlayItem({
            response: response,
            index: this.dialogIndex,
          });
        });
      }
    },
    // 年齢ボタンの押下された内容に応じてデータを取得して画面へ表示する
    switchSelectOld: function (index) {
      // 押された年齢のボタンの色を活性化
      switch (index) {
        case 0:
          this.isActiveOldBtn0 = true;
          this.isActiveOldBtn1 = false;
          this.isActiveOldBtn2 = false;
          this.setOld({ playOld: 0 });
          break;
        case 1:
          this.isActiveOldBtn0 = false;
          this.isActiveOldBtn1 = true;
          this.isActiveOldBtn2 = false;
          this.setOld({ playOld: 1 });
          break;
        case 2:
          this.isActiveOldBtn0 = false;
          this.isActiveOldBtn1 = false;
          this.isActiveOldBtn2 = true;
          this.setOld({ playOld: 3 });
          break;
        default:
          break;
      }

      // TODO: データセットの仕方の変更 https://javascript.programmer-reference.com/js-array-judgement/
      // TODO: 選択された年齢に応じた遊び検索をする→遊びデータを増やす必要がある
      // 子供の年齢が選択されたらその年齢に応じて表示している遊びを切り替える
      // 現在表示している遊びオブジェクトからループでカテゴリを取得して、遊びを取得する
      let innner_query = '';
      const innner_random = 1;
      // const innner_old = '';

      for (let k of Object.keys(this.displayPlayItemState)) {
        innner_query = '';
        innner_query += 'random=' + innner_random;
        innner_query += '&category=' + this.displayPlayItemState[k].category;
        // innner_query += '&old=' + innner_old;

        console.log('getPlayCardItem: query:' + innner_query);

        // eslint-disable-next-line no-undef
        axios.get(`/api/playproduct?` + innner_query).then((response) => {
          // this.displayPlayItemState.splice(k, 1, response.data[0]);
          this.spliceDisplayPlayItem({
            response: response,
            index: k,
          });
        });
      }
    },
  },
};
</script>


