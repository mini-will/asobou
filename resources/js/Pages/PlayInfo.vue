<template>
  <div>
    <v-container>
      <v-row>
        <v-col>
          <router-link :to="{ name: 'PlayIndex' }">あそび一覧へ戻る</router-link>

          <!-- <h1 class="my-4">{{ temp[0].display_name }}</h1> -->

          <!-- <p>{{ this.getPlayCardsById(Number($route.params.id)) }}</p> -->
          <!-- <p>{{ temp[0].kanji_name }}</p> -->
          <!-- <p>{{ $route.params.id }}</p> -->

          <!-- <youtube :video-id="temp[0].videoId" />

          <p class="headline mt-4">どうぐ</p>
          <p>{{ temp[0].tool_tags }}</p>

          <p class="headline py-1">あそびかた</p>
          <p>{{ temp[0].description }}</p>-->
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {};
  },
  created: function() {},
  mounted: function() {},
  computed: {}
};
</script>

