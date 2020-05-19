<template>
  <v-app>
    <v-container>
      <br />
      <h2>あそびをえらんでね</h2>
      <div v-if="!loading">
        <v-row>
          <v-col
            v-for="playcard in playcards"
            :key="playcard.id"
            cols="12"
            sm="6"
            class="d-flex justify-center"
          >
            <v-card>
              <v-responsive :aspect-ratio="16 / 9">
                <v-img
                  :src="playcard.src"
                  class="white--text align-end"
                  gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                  height="200px"
                >
                  <v-card-title v-text="playcard.title" class="headline font-weight-bold"></v-card-title>
                </v-img>

                <v-card-text>
                  <div class="text--primary">sample text .......</div>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>

                  <v-btn icon>
                    <v-icon>mdi-heart</v-icon>
                  </v-btn>

                  <v-btn icon>
                    <v-icon>mdi-bookmark</v-icon>
                  </v-btn>

                  <v-btn icon>
                    <v-icon>mdi-share-variant</v-icon>
                  </v-btn>
                </v-card-actions>
              </v-responsive>
            </v-card>
          </v-col>
        </v-row>
      </div>

      <div v-else>Loading...</div>
    </v-container>
  </v-app>
</template>

<script>
export default {
  data() {
    return {
      playcards: null,
      loading: false
      // cards: [
      //     {
      //         id: 1,
      //         title: "どうぶつのもり",
      //         src: "http://img.youtube.com/vi/YO-wTijsPcs/hqdefault.jpg",
      //         flex: 6
      //     },
      // ]
    };
  },
  created() {
    this.loading = true;
    axios.get(`/api/playindex?play_category=oyatsu`).then(response => {
      this.playcards = response.data;
      this.loading = false;

      console.log(this.playcards);
    });
  },
  method: {}
};
</script>
