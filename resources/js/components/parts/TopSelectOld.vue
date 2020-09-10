<template>
  <div>
    <transition>
      <div class="select-old-text">
        <div class="mt-5">
          <h2 class="mt-4">なんさいですか？</h2>
          <p class="caption">選んだ年齢に応じた遊びが表示されます</p>
        </div>
      </div>
    </transition>

    <div class="select-old-btn">
      <v-row style="height: 80px;" justify="center" align-content="center">
        <v-btn
          min-width="90"
          height="50"
          outlined
          color="#e8642b"
          @click="switchSelectOld(0)"
          :class="{
            'select-old-btn-red white--text font-weight-bold subtitle-1': isActiveOldBtn0,
          }"
          >0さい</v-btn
        >
        <v-btn
          min-width="90"
          height="50"
          outlined
          color="#64BBB1"
          class="mx-4"
          @click="switchSelectOld(1)"
          :class="{
            'select-old-btn-green lighten-2 white--text font-weight-bold subtitle-1': isActiveOldBtn1,
          }"
          >1-2さい</v-btn
        >
        <v-btn
          min-width="90"
          height="50"
          outlined
          color="#e8642b"
          @click="switchSelectOld(2)"
          :class="{
            'select-old-btn-red lighten-2 white--text font-weight-bold subtitle-1': isActiveOldBtn2,
          }"
          >3さい〜</v-btn
        >
      </v-row>
    </div>

    <!-- 女の子のアイコン画像を表示 -->
    <transition appear>
      <div class="child-img" v-if="show">
        <v-avatar class="child-img-avatar" size="100">
          <v-img v-bind:src="imageurl_Old" max-height="100" max-width="100" />
        </v-avatar>
      </div>
    </transition>
  </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex';

export default {
  data() {
    return {
      show: true,

      // 年齢を選択するボタンの制御
      isActiveOldBtn0: false,
      isActiveOldBtn1: false,
      isActiveOldBtn2: false,

      //年齢選択時に表示する画像
      imageurl_Old: require('../../../assets/child_old_main1-min.png'),
    };
  },
  computed: {
    store() {
      return this.$store.state;
    },
    ...mapState(['playOldState', 'displayPlayItemState']),
  },
  methods: {
    ...mapMutations(['setOld', 'setDisplayPlayItem', 'spliceDisplayPlayItem']),

    // 年齢ボタンの押下された内容に応じてデータを取得して画面へ表示する
    switchSelectOld: function (index) {
      // 押された年齢のボタンの色を活性化
      switch (index) {
        case 0:
          this.isActiveOldBtn0 = true;
          this.isActiveOldBtn1 = false;
          this.isActiveOldBtn2 = false;
          this.setOld({ playOld: 0 });
          this.imageurl_Old = require('../../../assets/child_old0-min.png');
          break;
        case 1:
          this.isActiveOldBtn0 = false;
          this.isActiveOldBtn1 = true;
          this.isActiveOldBtn2 = false;
          this.setOld({ playOld: 1 });
          this.imageurl_Old = require('../../../assets/child_old1-min.png');
          break;
        case 2:
          this.isActiveOldBtn0 = false;
          this.isActiveOldBtn1 = false;
          this.isActiveOldBtn2 = true;
          this.setOld({ playOld: 3 });
          this.imageurl_Old = require('../../../assets/child_old3-min.png');
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

      for (let k of Object.keys(this.displayPlayItemState)) {
        innner_query = '';
        innner_query += 'random=' + innner_random;
        innner_query += '&category=' + this.displayPlayItemState[k].category;

        if (this.playOldState !== 999) {
          // 対象年齢が999のときは年齢での検索を設定しない
          innner_query += '&old=' + this.playOldState;
        }

        // console.log('getPlayCardItem: query:' + innner_query);

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

<style scoped lang="css">
.select-old-text {
  color: #e8642b;
}
.select-old-btn-red {
  background-color: #e8642b !important;
}
.select-old-btn-green {
  background-color: #64bbb1 !important;
}
.child-img {
  margin: 10px auto;
  max-width: 100px;
  margin-bottom: 40px;
}
.child-img-avatar {
  border: solid 1px #e8642b;
}
.explain-text {
  margin: 10px auto;
  max-width: 400px;
}
</style>
