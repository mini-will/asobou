<template>
  <div>
    <v-container
      color="#FFC107"
      class="text-center"
      fluid
      style="max-height: 100%;"
    >
      <!-- 遊び年齢の選択 -->
      <TopSelectOld />

      <!-- 遊び選択してねのテキスト表示 -->
      <TopSelectPlayText />

      <!-- 遊びアイテムを表示 -->
      <div v-if="!loading">
        <div class="v-card-warpper">
          <v-row>
            <!-- <transition-group name="list" tag="play-list"> -->
            <v-col
              v-for="(playcard, index) in displayPlayItemState"
              :key="playcard.id"
              cols="6"
              sm="6"
              md="3"
              lg="3"
            >
              <h3 class="mb-1">
                <div
                  class="category-title"
                  :class="
                    index % 2 === 0 ? 'playcard-even-green' : 'playcard-odd-red'
                  "
                >
                  <span class="material-icons">{{
                    categoryIcon(playcard.category)
                  }}</span>
                  {{ categoryWamei(playcard.category) }}
                </div>
              </h3>

              <v-card class="playcard-warpper mb-4">
                <v-responsive :aspect-ratio="16 / 9">
                  <router-link
                    :to="{ name: 'PlayInfo', params: { id: playcard.id } }"
                  >
                    <v-img
                      :src="playcard.image_url"
                      class="white--text align-end"
                      gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                      height="200px"
                    >
                      <v-card-title
                        v-text="playcard.display_name"
                        class="headline font-weight-bold"
                      ></v-card-title>
                    </v-img>
                  </router-link>

                  <v-card-actions>
                    <div class="card-change-button">
                      <v-btn
                        color="#CA9639"
                        class="white--text"
                        @click.stop="
                          switchDialog(playcard.id, playcard.category, index)
                        "
                      >
                        <span class="material-icons mr-1 change-icon"
                          >cached</span
                        >
                        チェンジ
                      </v-btn>
                    </div>
                  </v-card-actions>
                </v-responsive>
              </v-card>
            </v-col>
            <!-- </transition-group> -->
          </v-row>
        </div>
      </div>

      <div v-else>
        <vue-loading
          class="mt-10"
          type="spiningDubbles"
          color="#FFC107"
          :size="{ width: '50px', height: '50px' }"
        ></vue-loading>
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

    <AboutApp />

    <div class="sns-share">
      <ShareApp />
    </div>

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
  </div>
</template>

<script>
import { mapState, mapMutations } from 'vuex';
import DialogRandom from '../parts/DialogRandom.vue';
import AboutApp from '../parts/AboutApp.vue';
import ShareApp from '../parts/ShareApp.vue';
import TopSelectOld from '../parts/TopSelectOld.vue';
import TopSelectPlayText from '../parts/TopSelectPlayText.vue';

export default {
  components: {
    DialogRandom,
    AboutApp,
    ShareApp,
    TopSelectOld,
    TopSelectPlayText,
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
          this.setDisplayPlayItem({ response: response });
          this.loading = false;

          // setTimeout(() => {
          //   this.loading = false;
          // }, 8000);
        });
    },
    getInitialPlayData: function () {
      // state playItemにデータが無いときだけ初回データを取得する
      if (this.displayPlayItemState.length === 0) {
        this.getPlayCard('singing');
        this.getPlayCard('making');
        this.getPlayCard('exercise');
        this.getPlayCard('snack');
      }
    },
    // Dialog on(true)にしてダイアログを表示する
    switchDialog: function (playId, playCategory, playIndex) {
      this.dialogOnOff = !this.dialogOnOff;
      this.dialogPlayId = Number(playId);
      this.dialogCategory = String(playCategory);
      this.dialogIndex = Number(playIndex);
    },
    // DialogRandom component からemitで呼び出す処理
    switchMainPlay: function (playId, playCategory, playIndex) {
      this.dialogOnOff = !this.dialogOnOff;
      this.dialogPlayId = Number(playId);
      this.dialogCategory = String(playCategory);
      this.dialogIndex = Number(playIndex);

      // ダイアログで遊びカードを選択したときはplayIDが取得できる
      if (typeof playId == 'number') {
        // console.log('switchDialog: play入れ替え ' + playId);

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
    categoryWamei: function (category) {
      switch (category) {
        case 'singing':
          return 'うた';
        case 'snack':
          return 'おやつ';
        case 'exercise':
          return 'うんどう';
        case 'making':
          return 'こうさく';
        default:
          break;
      }
    },
    categoryIcon: function (category) {
      switch (category) {
        case 'singing':
          return 'music_video';
        case 'snack':
          return 'local_cafe';
        case 'exercise':
          return 'directions_run';
        case 'making':
          return 'brush';
        default:
          break;
      }
    },
  },
};
</script>

<style scoped lang="css">
.v-card-warpper {
  background-color: #f6f6f8;
}
.playcard-even-green {
  color: #64bbb1;
}
.playcard-odd-red {
  color: #e8642b;
}
.category-title span {
  vertical-align: middle;
}
.playcard-warpper {
  max-width: 400px;
}
.card-change-button {
  margin: auto;
}
.change-icon {
  font-size: 18px;
}
.sns-share {
  margin-bottom: 50px;
}

.v-enter-active,
.v-leave-active {
  transition: opacity 0.5s;
}
.v-enter,
.v-leave-to {
  opacity: 0;
}
.list-item {
  /* display: inline-block; */
  margin-right: 10px;
}
.list-enter-active,
.list-leave-active {
  transition: 0.5s;
}
.list-enter, .list-leave-to /* .list-leave-active for below version 2.1.8 */ {
  opacity: 0;
}
</style>
