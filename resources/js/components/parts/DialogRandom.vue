<template>
  <div>
    <v-dialog :value="this.$props.dialogOn" @input="chagenDialogOnOff" overlay-opacity="0.7">
      <div style="background-color: lightgray">
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
                  @click="selectMainPlay(playcard.id)"
                >
                  <v-card-title v-text="playcard.display_name" class="headline font-weight-bold"></v-card-title>
                </v-img>
              </v-responsive>
            </v-card>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" sm="12" class="d-flex justify-center">
            <v-btn @click="getPlayCardItem(2, 'exercise', 3)" justify="center">ほかの</v-btn>
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
  },
  data() {
    return {
      loading: false,
      dialogPlayCards: [],
      query: '',
    };
  },
  created() {},
  mounted() {
    this.getPlayCardItem(2, this.playCategory, 3);
  },
  beforeUpdate() {},
  computed: {},
  methods: {
    getPlayCardItem: function (random, category, old) {
      this.loading = true;

      this.query = '';
      if (random != '') {
        this.query += 'random=' + random;
      }
      if (category != '') {
        this.query += '&category=' + category;
      }
      if (old != '') {
        this.query += '&old=' + old;
      }
      console.log(this.query);

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
    selectMainPlay: function (playId) {
      this.$emit('dialog-change', playId);
    },
    chagenDialogOnOff() {
      this.$emit('dialog-change', '');
    },
  },
};
</script>
