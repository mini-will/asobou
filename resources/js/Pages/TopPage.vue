<template>
  <v-container>
    <!-- 検索設定UI -->
    <v-row justify="center" no-gutters class="mt-4">
      <v-col class="d-flex" cols="12" sm="9">
        <v-select :items="older" filled label="なんさい" dense></v-select>
      </v-col>
      <v-col class="d-flex" cols="6" sm="6">
        <v-switch v-model="teppan" :label="`鉄板の遊び`"></v-switch>
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
                <v-btn @click.stop="dialogIn = true">ほかの</v-btn>
              </v-card-actions>
            </v-responsive>
          </v-card>
        </v-col>
      </v-row>

      <!-- ■ダイアログ -->
      <v-dialog v-model="dialog" overlay-opacity="0.7">
        <!-- <div style="background-color: lightgray">
            <v-row>
              <v-col
                v-for="(playcard,index) in temp4"
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
                      @click="switchMainPlayOut(playcard.id)"
                    >
                      <v-card-title
                        v-text="playcard.display_name"
                        class="headline font-weight-bold"
                      ></v-card-title>
                    </v-img>
                  </v-responsive>
                </v-card>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" sm="12" class="d-flex justify-center">
                <v-btn @click="setPlaydata4" justify="center">ほかの</v-btn>
              </v-col>
            </v-row>
        </div>-->
      </v-dialog>
    </div>

    <div v-else>Loading...</div>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    older: ["0", "1", "2", "3", "4", "5", "6"],
    teppan: false,
    playcards: [],
    loading: false,
    isActiveIn: false,
    playLiked: [],
    dialog: false
  }),
  created() {
    this.getPlayCard("snack");
  },

  mounted() {},
  methods: {
    getPlayCard: function(category) {
      this.loading = true;
      axios.get(`/api/search?category=${category}`).then(response => {
        // this.$set(this.playcards, "test", "response.data");
        this.playcards.push(response.data[0]);
        this.loading = false;
      });
      // console.log(response.data[0]);
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
    }
  }
};
</script>
