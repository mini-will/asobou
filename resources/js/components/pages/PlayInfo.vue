<template>
  <div>
    <v-container>
      <v-row>
        <v-col>
          <router-link :to="{ name: 'toppage' }" class="my-10 ml-2">あそび一覧へ戻る</router-link>
        </v-col>
      </v-row>

      <v-row>
        <v-col cols="12">
          <div class="play-explain" v-if="!loading">
            <h2 class="my-4">{{ playProduct[0].display_name }}</h2>
            <v-card>
              <youtube :video-id="playProduct[0].youtube_video_Id" :fitParent="innerFitParent" />
            </v-card>

            <h3 class="mt-8">どうぐ</h3>
            <p class="mb-8">{{ playProduct[0].tool_tags }}</p>

            <h3 class="py-1">あそびかた</h3>
            <p class="mb-8">{{ playProduct[0].description }}</p>
          </div>

          <div v-else>
            <h3>loading....</h3>
          </div>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
import Vue from 'vue';
import VueYoutube from 'vue-youtube';

Vue.use(VueYoutube);

export default {
  data() {
    return {
      loading: false,
      playProduct: [],
      innerFitParent: true,
    };
  },
  created() {
    this.getPlayProductById(Number(this.$route.params.id));
  },
  mounted: function () {},
  computed: {},
  methods: {
    getPlayProductById: function (id) {
      this.loading = true;
      // eslint-disable-next-line no-undef
      axios.get(`/api/playproduct/${id}`).then((response) => {
        // this.$set(this.playcards, "test", "response.data");
        this.playProduct.push(response.data);
        this.loading = false;
        // console.log(response.data);
      });
    },
  },
};
</script>

<style scoped lang="css">
h2,
h3 {
  color: #e8642b;
}
</style>
