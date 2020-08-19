<template>
  <div>
    <v-dialog :value="this.$props.dialogOn" @input="chagenDialogOnOff" overlay-opacity="0.7">
      <div style="background-color: lightgray;">
        <v-row>
          <v-col
            v-for="(playcard, index) in dialogPlayCards"
            :key="index + playcard.id"
            cols="6"
            sm="6"
            class="d-flex justify-center"
          >
            <v-card>
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
              @click="getPlayCardItem(2, playCategory, 3)"
              justify="center"
              color="#4FC3F7"
            >チェンジ</v-btn>
          </v-col>
        </v-row>
      </div>
    </v-dialog>
  </div>
</template>

<script>
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
    };
  },
  created() {},
  beforeMount() {},
  mounted() {
    // Dialogがonでplaycardデータが空の場合は、データ取得が必要な状態のためplaydataを取得する
    if (this.dialogOn === true && this.dialogPlayCards === null) {
      this.getPlayCardItem(2, this.playCategory, 999);
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
      this.getPlayCardItem(2, this.playCategory, 999);
    }
  },
  beforeDestroy() {
    console.log('before destroy');
  },
  computed: {},
  methods: {
    getPlayCardItem: function (random, category, old) {
      this.loading = true;

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
  },
};
</script>
