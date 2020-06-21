<template>
  <v-container>
    <!-- 検索設定UI -->
    <v-row justify="center" no-gutters class="mt-4">
      <v-col class="d-flex" cols="12" sm="9">
        <!-- このページを参考にv-selectを実装
        https://codepen.io/fromarm4/pen/xzMyKv?__cf_chl_jschl_tk__=56a2537eb510bd440f1403551a576f416318bc3a-1592632997-0-AdjKfvk3_y3U-R4SenemIpCy7Gv9es0L45AMuMEf0PzYxftlNUoilG4_QiNgVuJSWk_OJUR-ejfv801nn1nnwI67QNA0c61hWNG3QjcI5Civ6TosA-8UlBmgLshOO2zaalokEqPAQh0Os1LsLiBrmr0aBXc-9mXmbJUO83hIEUGDF_3CGkDmNMF3tUtu8HL1Edl7bXoDIekyxD63nJYhM8GkWEp1MYr6xwt4nrAw2c5JL52LDciDob-W20FTQb57SXYOrLycpjFe08PMMdfvGtjd8PvOS_KNoZxHEFlarAsRP3L2jeZkB3guHlUAA0yU-zzEbGsPpkEFkwI9PTZ5gKo37DwGVNWJCkN98YIZNrTs-->
        <v-select
          label="なんさい"
          @input="updateValue($event, 'activePlayOld')"
          :items="playOld"
          :value="$store.state.form.activePlayOld"
          dense
        ></v-select>
        <!-- <p>{{ $store.state.form.activePlayOld }}</p> -->
      </v-col>

      <!-- TODO:トグルボタンとvuex -->
      <v-col class="d-flex" cols="6" sm="6">
        <v-switch
          label="鉄板の遊び"
          @input="updateValue($event, 'activeTeppan')"
          :items="teppan"
          :value="$store.state.form.activeTeppan"
          dense
        ></v-switch>

        <!-- <v-switch v-model="teppan" :label="`鉄板の遊び`"></v-switch> -->
      </v-col>
      <v-col class="d-flex mt-2" cols="6" sm="6">
        <v-btn color="secondary">遊びを選ぶ</v-btn>
      </v-col>
    </v-row>

    <v-row justify="center" no-gutters></v-row>

    <!-- 遊びを表示 -->
    <h2 class="mt-10">あそびをえらんでね</h2>
    <div v-if="!loading">
      <v-row>
        <v-col>
          <v-card class="mb-4">
            <v-responsive :aspect-ratio="16 / 9">
              <router-link :to="{name: 'PlayInfo',params: { id: playcards[0].id }}">
                <v-img
                  :src="playcards[0].image_url"
                  class="white--text align-end"
                  gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                  height="200px"
                >
                  <v-card-title
                    v-text="playcards[0].display_name"
                    class="headline font-weight-bold"
                  ></v-card-title>
                </v-img>
              </router-link>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn icon v-on:click="color_switch(playcards[0].id)">
                  <v-icon v-if="isActiveIn === false">mdi-heart</v-icon>
                  <v-icon v-else color="pink">mdi-heart</v-icon>
                </v-btn>
                <v-btn @click.stop="dialog1 = true">ほかの</v-btn>
              </v-card-actions>
            </v-responsive>
          </v-card>
        </v-col>
      </v-row>

      <!-- ■ダイアログ -->
      <v-dialog v-model="dialog1" overlay-opacity="0.7">
        <div style="background-color: lightgray">
          <v-row>
            <v-col
              v-for="(playcard,index) in dialogPlayCards"
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
                    @click="switchMainPlay(playcard.id)"
                  >
                    <v-card-title v-text="playcard.display_name" class="headline font-weight-bold"></v-card-title>
                  </v-img>
                </v-responsive>
              </v-card>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" sm="12" class="d-flex justify-center">
              <v-btn @click="this.getPlayCardItem(2,'snack','')" justify="center">ほかの</v-btn>
            </v-col>
          </v-row>
        </div>
      </v-dialog>
    </div>

    <div v-else>Loading...</div>
  </v-container>
</template>

<script>
import { mapState, mapGetters } from "vuex";

export default {
  data() {
    return {
      loading: false,
      isActiveIn: false,
      playLiked: [],

      playcards: [],

      dialog1: false,
      dialogPlayCards: [],
      query: ""
    };
  },
  created() {
    this.getPlayCard("snack");
    this.getPlayCardItem(2, "snack", "");
  },
  mounted() {},
  computed: {
    store() {
      return this.$store.state;
    },
    ...mapState(["playOld"]),
    ...mapState(["form.activePlayOld"]),
    ...mapState(["teppan"]),
    ...mapState(["form.activeTeppan"])
  },
  methods: {
    getPlayCard: function(category) {
      this.loading = true;
      axios
        .get(`/api/playproduct?category=${category}&random=1`)
        .then(response => {
          // this.$set(this.playcards, "test", "response.data");
          this.playcards.push(response.data[0]);
          this.loading = false;
        });
    },
    getPlayCardItem: function(random, category, old) {
      this.loading = true;

      if (random != "") {
        this.query += "random=" + random;
      }
      if (category != "") {
        this.query += "&category=" + category;
      }
      if (old != "") {
        this.query += "&old=" + old;
      }
      // console.log(this.query);

      axios.get(`/api/playproduct?` + this.query).then(response => {
        this.loading = false;
        this.dialogPlayCards = response.data;
        return response.data;
      });
    },

    getPlayProductById: function(playId) {
      axios.get(`/api/playproduct/${playId}`).then(response => {
        return response.data;
      });
    },

    switchMainPlay: function(playId) {
      this.playcards.splice(0, 1, this.getPlayProductById(playId));
      this.dialog1 = false;
    },

    color_switch(playId) {
      this.isActiveIn = !this.isActiveIn;
      this.playLiked.splice(0, 1, {
        id: 1,
        user: "testUser",
        playId: playId,
        liked: this.isActiveIn,
        display: "show"
      });
    },
    updateValue(vals, key_name) {
      this.$store.commit("updateValue", { vals, key_name });
    }
  }
};
</script>
