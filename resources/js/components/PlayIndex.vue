<template>
    <v-app>
        <v-container>
            <br />
            <h2>あそびをえらんでね</h2>

            <v-row>
                <v-col
                    v-for="card in cards"
                    :key="card.title"
                    :cols="card.flex"
                    class="d-flex justify-center"
                >
                    <v-card>
                        <v-responsive :aspect-ratio="16 / 9">
                            <v-img
                                :src="card.src"
                                class="white--text align-end"
                                gradient="to bottom, rgba(0,0,0,.1), rgba(0,0,0,.5)"
                                height="200px"
                            >
                                <v-card-title
                                    v-text="card.title"
                                ></v-card-title>
                            </v-img>

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
        </v-container>
    </v-app>
</template>

<script>
export default {
    data: () => ({
        cards: [
            {
                id: 1,
                title: "どうぶつのもり",
                src: "http://img.youtube.com/vi/YO-wTijsPcs/hqdefault.jpg",
                flex: 6
            },
            {
                id: 2,
                title: "おやつ",
                src: "http://img.youtube.com/vi/izjA7bqmH3k/hqdefault.jpg",
                flex: 6
            },
            {
                id: 3,
                title: "おやつ パンケーキ",
                src: "http://img.youtube.com/vi/yvkRI8E5UdY/hqdefault.jpg",
                flex: 6
            },
            {
                id: 4,
                title: "おりがみ つる",
                src: "http://img.youtube.com/vi/qtP3TmvGUZk/hqdefault.jpg",
                flex: 6
            },
            {
                id: 5,
                title: "おりがみ　すいっち",
                src: "http://img.youtube.com/vi/GjyJsPMUDTA/hqdefault.jpg",
                flex: 6
            },
            {
                id: 6,
                title: "おりがみ しゅりけん",
                src: "http://img.youtube.com/vi/0_Ex9uXFI_A/hqdefault.jpg",
                flex: 6
            },
            {
                id: 7,
                title: "なわとび",
                src: "http://img.youtube.com/vi/2NNFyE3AtVg/sddefault.jpg",
                flex: 6
            },
            {
                id: 8,
                title: "からだをうごかす すとらいだー",
                src: "http://img.youtube.com/vi/lfQpg0a06XE/sddefault.jpg",
                flex: 6
            },
            {
                id: 9,
                title: "からだをうごかす さんりんしゃ",
                src: "http://img.youtube.com/vi/TWE8cjkNNj0/sddefault.jpg",
                flex: 6
            },
            {
                id: 10,
                title: "えをかく みっきー",
                src: "http://img.youtube.com/vi/npad23BoXic/hqdefault.jpg",
                flex: 6
            }
        ]
    })
};
</script>
