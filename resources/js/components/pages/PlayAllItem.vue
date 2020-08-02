<template>
  <div>
    <h1 class="display-1 font-weight-bold ma-4">ぜんぶのあそび</h1>

    <v-row>
      <v-col
        v-for="(playcard, index) in playCards"
        :key="index + playcard.id"
        cols="12"
        sm="6"
        md="4"
        lg="3"
        class="d-flex justify-center my-4"
      >
        <v-card>
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
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      playCards: [],
    };
  },
  created() {
    this.getPlayProductALL();
  },
  computed: {},
  methods: {
    getPlayProductALL: function () {
      this.loading = true;
      // eslint-disable-next-line no-undef
      axios.get(`/api/playproduct`).then((response) => {
        // this.playCards.push(response.data);
        this.playCards = response.data;
        this.loading = false;
        console.log(response.data);
      });
    },
  },
};
</script>
