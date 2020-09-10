<template>
  <div>
    <v-dialog :value="this.$props.dialogOn" @input="chagenDialogOnOff" overlay-opacity="0.8">
      <div style="background-color: #f6f6f8;">
        <v-row>
          <v-col
            v-for="(playcard, index) in dialogPlayCards"
            :key="index + playcard.id"
            cols="6"
            sm="6"
            md="6"
            lg="6"
            class="d-flex justify-center"
          >
            <v-card class="playcard-warpper">
              <v-responsive :aspect-ratio="16 / 9">
                <v-img
                  :src="playcard.image_url"
                  class="white--text align-end"
                  gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                  height="200px"
                  @click="
                    selectMainPlay(playcard.id, playcard.category, playIndex)
                  "
                >
                  <v-card-title v-text="playcard.display_name" class="headline font-weight-bold"></v-card-title>
                </v-img>
              </v-responsive>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="12" class="d-flex justify-center">
            <v-btn
              @click="getPlayCardItem(4, playCategory, playOldState)"
              justify="center"
              color="#CA9639"
              class="white--text"
            >
              <span class="change-icon material-icons mr-1">cached</span>
              チェンジ
            </v-btn>
          </v-col>
        </v-row>

        <div class="child-img">
          <v-avatar color="grey lighten-4" size="100">
            <v-img
              class="child-img-avatar"
              v-bind:src="imageurl_chage_child"
              max-height="100"
              max-width="100"
            />
          </v-avatar>
        </div>

        <v-responsive class="mx-auto mb-1" width="56">
          <v-divider></v-divider>
        </v-responsive>
      </div>
    </v-dialog>
  </div>
</template>

<script>
import { mapState } from 'vuex';

export default {
  props: {
    dialogOn: {
      type: Boolean,
      required: true,
    },
    playId: {
      type: Number,
      required: true,
    },
    playCategory: { type: String, required: true },
    playIndex: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      loading: false,
      dialogPlayCards: null,
      query: '',

      imageurl_chage_child: require('../../../assets/child_change_1_hi.png'),

      imageurl_chage_child_1: require('../../../assets/change_image/child_1-min.png'),
      imageurl_chage_child_2: require('../../../assets/change_image/child_2-min.png'),
      imageurl_chage_child_3: require('../../../assets/change_image/child_3-min.png'),
      imageurl_chage_child_4: require('../../../assets/change_image/child_4-min.png'),
      imageurl_chage_child_5: require('../../../assets/change_image/child_5-min.png'),
      imageurl_chage_child_6: require('../../../assets/change_image/child_6-min.png'),
      imageurl_chage_child_7: require('../../../assets/change_image/child_7-min.png'),
      imageurl_chage_child_8: require('../../../assets/change_image/child_8-min.png'),
      imageurl_chage_child_9: require('../../../assets/change_image/child_9-min.png'),
      imageurl_chage_child_10: require('../../../assets/change_image/child_10-min.png'),
      imageurl_chage_child_11: require('../../../assets/change_image/child_11-min.png'),
      imageurl_chage_child_12: require('../../../assets/change_image/child_12-min.png'),
      imageurl_chage_child_13: require('../../../assets/change_image/child_13-min.png'),
      imageurl_chage_child_14: require('../../../assets/change_image/child_14-min.png'),
      imageurl_chage_child_15: require('../../../assets/change_image/child_15-min.png'),
      imageurl_chage_child_16: require('../../../assets/change_image/child_16-min.png'),
      imageurl_chage_child_17: require('../../../assets/change_image/child_17-min.png'),
      imageurl_chage_child_18: require('../../../assets/change_image/child_18-min.png'),
      imageurl_chage_child_19: require('../../../assets/change_image/child_19-min.png'),
      imageurl_chage_child_20: require('../../../assets/change_image/child_20-min.png'),
      imageurl_chage_child_21: require('../../../assets/change_image/child_21-min.png'),
      imageurl_chage_child_22: require('../../../assets/change_image/child_22-min.png'),
    };
  },
  created() {},
  beforeMount() {},
  mounted() {
    // Dialogがonでplaycardデータが空の場合は、データ取得が必要な状態のためplaydataを取得する
    if (this.dialogOn === true && this.dialogPlayCards === null) {
      this.getPlayCardItem(4, this.playCategory, this.playOldState);
    }

    // console.log('mounted');
  },
  beforeUpdate() {},
  updated() {
    // console.log(
    //   'updated:' + this.dialogOn,
    //   this.playId,
    //   this.playCategory,
    //   this.dialogPlayCards,
    //   this.playIndex
    // );

    // Dialogがonでplaycardデータが空の場合は、データ取得が必要な状態のためplaydataを取得する
    if (this.dialogOn === true && this.dialogPlayCards === null) {
      this.getPlayCardItem(4, this.playCategory, this.playOldState);
    }
  },
  beforeDestroy() {
    // console.log('before destroy');
  },
  computed: {
    ...mapState(['playOldState']),
  },
  methods: {
    getPlayCardItem: function (random, category, old) {
      this.loading = true;

      // ダイアログを最初に開いたときのアイコンを笑顔のアイコンに固定
      if (this.dialogOn === true && this.dialogPlayCards === null) {
        this.imageurl_chage_child = require('../../../assets/child_change_1_hi.png');
      } else {
        this.chageImageIcon();
      }

      this.query = '';
      if (random !== '') {
        this.query += 'random=' + random;
      }
      if (category !== '') {
        this.query += '&category=' + category;
      }
      if (old !== '') {
        if (old !== 999) {
          // 対象年齢が999のときは年齢での検索を設定しない
          this.query += '&old=' + old;
        }
      }
      // console.log('getPlayCardItem: query:' + this.query);

      // eslint-disable-next-line no-undef
      axios.get(`/api/playproduct?` + this.query).then((response) => {
        this.loading = false;
        this.dialogPlayCards = response.data;
      });
    },
    getPlayProductById: function (playId) {
      // eslint-disable-next-line no-undef
      axios.get(`/api/playproduct/${playId}`).then((response) => {
        return response.data;
      });
    },
    // 遊びカードを選択してダイアログを閉じる処理
    selectMainPlay: function (playId, playCategory, playIndex) {
      this.$emit('dialog-change', playId, playCategory, playIndex);
      // console.log(
      //   'dialog-change: playID ' +
      //     playId +
      //     ', playCategory ' +
      //     playCategory +
      //     ', playIndex ' +
      //     playIndex
      // );
      // ダイアログを閉じるときにdialogPlayCardsデータを削除してダイアログが閉じられてる状態で、
      // もう一度ダイアログを開いたときは再度データ取得が必要な状態とする
      this.dialogPlayCards = null;
    },
    // ダイアログを閉じる処理
    chagenDialogOnOff() {
      // ダイアログを閉じるときにdialogPlayCardsデータを削除してダイアログが閉じられてる状態で、
      // もう一度ダイアログを開いたときは再度データ取得が必要な状態とする
      // vuetify dialogのcloseイベントを直接拾えなかったための代替処理
      this.dialogPlayCards = null;

      // console.log('chagenDialogOnOff:' + this.dialogPlayCards);
      this.$emit('dialog-change', '');
    },
    chageImageIcon() {
      var index = Math.floor(Math.random() * 22) + 1;

      // 画像URLの指定時に変数がうまく展開できず地道にURLを指定
      // nuxt.jsで:src="require(変数)"で画像パスを指定する時に。。 - Qiita
      // https://qiita.com/ryo2132/items/ed5e3f5eee1ba0c4c625

      switch (index) {
        case 1:
          this.imageurl_chage_child = this.imageurl_chage_child_1;
          return;
        case 2:
          this.imageurl_chage_child = this.imageurl_chage_child_2;
          return;
        case 3:
          this.imageurl_chage_child = this.imageurl_chage_child_3;
          return;
        case 4:
          this.imageurl_chage_child = this.imageurl_chage_child_4;
          return;
        case 5:
          this.imageurl_chage_child = this.imageurl_chage_child_5;
          return;
        case 6:
          this.imageurl_chage_child = this.imageurl_chage_child_6;
          return;
        case 7:
          this.imageurl_chage_child = this.imageurl_chage_child_7;
          return;
        case 8:
          this.imageurl_chage_child = this.imageurl_chage_child_8;
          return;
        case 9:
          this.imageurl_chage_child = this.imageurl_chage_child_9;
          return;
        case 10:
          this.imageurl_chage_child = this.imageurl_chage_child_10;
          return;
        case 11:
          this.imageurl_chage_child = this.imageurl_chage_child_11;
          return;
        case 12:
          this.imageurl_chage_child = this.imageurl_chage_child_12;
          return;
        case 13:
          this.imageurl_chage_child = this.imageurl_chage_child_13;
          return;
        case 14:
          this.imageurl_chage_child = this.imageurl_chage_child_14;
          return;
        case 15:
          this.imageurl_chage_child = this.imageurl_chage_child_15;
          return;
        case 16:
          this.imageurl_chage_child = this.imageurl_chage_child_16;
          return;
        case 17:
          this.imageurl_chage_child = this.imageurl_chage_child_17;
          return;
        case 18:
          this.imageurl_chage_child = this.imageurl_chage_child_18;
          return;
        case 19:
          this.imageurl_chage_child = this.imageurl_chage_child_19;
          return;
        case 20:
          this.imageurl_chage_child = this.imageurl_chage_child_20;
          return;
        case 21:
          this.imageurl_chage_child = this.imageurl_chage_child_21;
          return;
        case 22:
          this.imageurl_chage_child = this.imageurl_chage_child_22;
          return;
        default:
          break;
      }
    },
  },
};
</script>

<style scoped lang="css">
.playcard-warpper {
  /* max-width: 400px; */
}
.child-img {
  text-align: center;
}
.change-icon {
  font-size: 18px;
}
</style>
