<template>
  <v-container class="yellow lighten-4">
    <div class="select-old-text">
      <h3 class="my-4">なんさいですか？</h3>
    </div>

    <div class="select-old-btn">
      <v-row class="blue lighten-4" style="height: 50px;" justify="center" align-content="center">
        <v-btn min-width="90" color="white">0さい</v-btn>
        <v-btn min-width="90" color="white" class="mx-4">1-2さい</v-btn>
        <v-btn min-width="90" color="white">3さい〜</v-btn>
      </v-row>
    </div>

    <v-row class="green lighten-4 my-4" justify="center" align-content="center">
      <v-btn color="white">シャッフル</v-btn>
    </v-row>

    <!-- <v-row class="yellow lighten-4" style="height: 100px;" justify="center" align-content="center">
      <v-col cols="4" sm="3" md="2" lg="1" v-for="n in 3" :key="n">
        <v-btn min-width="90" color="white">{{n}}</v-btn>
      </v-col>
    </v-row>-->

    <!-- 遊びを表示 -->
    <div class="select-play-text">
      <h3 class="mt-6">あそびをえらんでね</h3>
    </div>
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
                <v-btn
                  color="accent"
                  @click.stop="switchDialog(playcard.id, playcard.category, index)"
                >ほかの</v-btn>
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
    this.getPlayCard('singing');
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

<style lang="css">
.select-old-text {
  text-align: center;
}

.select-old-btn {
  text-align: center;
}

.select-play-text {
  text-align: center;
}
</style>
