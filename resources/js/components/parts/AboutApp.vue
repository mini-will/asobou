<template>
  <div>
    <section id="about-asobiy">
      <div>
        <v-container class="text-center" fluid>
          <v-row>
            <v-col>
              <h2 class="my-4">Asobiyってなに？</h2>
              <p>
                毎日遊びを選ぶのも大変です。
                <br />同じ遊びばかりでは飽きてしまいますよね。
                <br />何で遊ぶか考える手間が省けないかとAsobiyを作りました。
              </p>
            </v-col>
          </v-row>
          <div class="explain-text">
            <v-img class="explain-text-img" :src="imageurl" max-height="600" max-width="400" />
          </div>
        </v-container>
      </div>
    </section>

    <section id="explain-old">
      <v-container class="text-center" fluid>
        <div class="explain-old-warpper">
          <h2 class="my-4">あそびのさがしかた</h2>
          <v-row>
            <v-col v-for="({ src, title, text }, i) in articles" :key="i" cols="12" md="4">
              <v-avatar
                :class="((i % 2) === 0) ? 'explain-old-avatar-even-red' : 'explain-old-avatar-odd-green'"
                size="100"
              >
                <v-img v-bind:src="src" max-height="100" max-width="100" />
              </v-avatar>
              <div
                :class="((i % 2) === 0) ? 'explain-old-text-even-red' : 'explain-old-text-odd-green'"
              >
                <div class="title mt-2 mb-1" v-text="title"></div>
                <div class="body-2 mb-4" v-text="text"></div>
              </div>
            </v-col>
          </v-row>
        </div>
      </v-container>
    </section>
  </div>
</template>

<script>
export default {
  data() {
    return {
      // トップページ下の説明文用の画像
      imageurl: require('../../../assets/shutterstock_1497902633-min.jpg'),

      articles: [
        {
          src: require('../../../assets/child_old0-min.png'),
          title: '0歳',
          text: '０歳の赤ちゃんは本当に可愛いですよね',
        },
        {
          src: require('../../../assets/child_old1-min.png'),
          title: '1-2歳',
          text:
            '1,2歳の子供は歩けるようになって、お話もできるようになってきます',
        },
        {
          src: require('../../../assets/child_old3-min.png'),
          title: '3歳〜',
          text: '３歳以上になってくるといろんな遊びができるようになってきます',
        },
      ],
    };
  },
};
</script>

<style lang="css">
.explain-text-img {
  margin: auto;
}

.explain-old-avatar-odd-green {
  border: solid 1px #64bbb1;
}
.explain-old-avatar-even-red {
  border: solid 1px #e8642b;
}
.explain-old-text-odd-green {
  color: #64bbb1;
}
.explain-old-text-even-red {
  color: #e8642b;
}

.explain-old-warpper {
  padding-top: 20px;
  margin-top: 30px;
  margin-bottom: 50px;
  background-color: #f6f6f8;
}

#about-asobiy {
  color: #e8642b;
}
#explain-old {
  color: #e8642b;
}
</style>