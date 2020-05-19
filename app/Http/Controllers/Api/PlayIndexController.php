<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayIndexController extends Controller
{
    public function show(Request $request)
    {
        $play_all = collect([
            [
                "id" =>  1,
                "title" => "どうぶつのもり",
                "src" => "http://img.youtube.com/vi/YO-wTijsPcs/hqdefault.jpg",
                "play_inout" => "in",
                "play_category" => "game",
                "flex" => 6
            ],
            [
                "id" => 2,
                "title" => "oyatsu サーターアンダギー",
                "src" => "http://img.youtube.com/vi/izjA7bqmH3k/hqdefault.jpg",
                "play_inout" => "in",
                "play_category" => "oyatsu",
                "flex" => 6
            ],
            [
                "id" => 3,
                "title" => "oyatsu パンケーキ",
                "src" => "http://img.youtube.com/vi/yvkRI8E5UdY/hqdefault.jpg",
                "play_inout" => "in",
                "play_category" => "oyatsu",
                "flex" => 6
            ],
            [
                "id" => 4,
                "title" => "おりがみ つる",
                "src" => "http://img.youtube.com/vi/qtP3TmvGUZk/hqdefault.jpg",
                "play_inout" => "in",
                "play_category" => "making",
                "flex" => 6
            ],
            [
                "id" => 5,
                "title" => "おりがみ すいっち",
                "src" => "http://img.youtube.com/vi/GjyJsPMUDTA/hqdefault.jpg",
                "play_inout" => "in",
                "play_category" => "making",
                "flex" => 6
            ], [
                "id" => 6,
                "title" => "おりがみ しゅりけん",
                "src" => "http://img.youtube.com/vi/0_Ex9uXFI_A/hqdefault.jpg",
                "play_inout" => "in",
                "play_category" => "making",
                "flex" => 6
            ], [
                "id" => 7,
                "title" => "なわとび",
                "src" => "http://img.youtube.com/vi/2NNFyE3AtVg/sddefault.jpg",
                "play_inout" => "out",
                "play_category" => "exercise",
                "flex" => 6
            ], [
                "id" => 8,
                "title" => "からだをうごかす すとらいだー",
                "src" => "http://img.youtube.com/vi/lfQpg0a06XE/sddefault.jpg",
                "play_inout" => "out",
                "play_category" => "exercise",
                "flex" => 6
            ], [
                "id" => 9,
                "title" => "からだをうごかす さんりんしゃ",
                "src" => "http://img.youtube.com/vi/TWE8cjkNNj0/sddefault.jpg",
                "play_inout" => "out",
                "play_category" => "exercise",
                "flex" => 6
            ], [
                "id" => 10,
                "title" => "えをかく ぬりえ",
                "src" => "http://img.youtube.com/vi/npad23BoXic/hqdefault.jpg",
                "play_inout" => "in",
                "play_category" => "making",
                "flex" => 6
            ],
            [
                "id" => 11,
                "title" => "うんどうする らじおたいそう",
                "src" => "http://img.youtube.com/vi/jPeHKtiFXIg/hqdefault.jpg",
                "play_inout" => "in",
                "play_category" => "exercise",
                "flex" => 6
            ],
            [
                "id" => 12,
                "title" => "べんきょうする ひらがな",
                "src" => "http://img.youtube.com/vi/GgKItOVLo8w/hqdefault.jpg",
                "play_inout" => "in",
                "play_category" => "study",
                "flex" => 6
            ],
            [
                "id" => 13,
                "title" => "oyatsu アイスクリーム",
                "src" => "https://www.meiji.co.jp/products/icecream/assets/img/4902705125308_product.jpg",
                "play_inout" => "in",
                "play_category" => "oyatsu",
                "flex" => 6
            ],
            [
                "id" => 14,
                "title" => "oyatsu バナナ",
                "src" => "https://www.sumifru.co.jp/img/trivia/nutrient-comment/img01.jpg",
                "play_inout" => "in",
                "play_category" => "oyatsu",
                "flex" => 6
            ],
            [
                "id" => 15,
                "title" => "oyatsu ポテトチップス",
                "src" => "https://koikeya.co.jp/potatochips/top_images/011801261018552266.png",
                "play_inout" => "in",
                "play_category" => "oyatsu",
                "flex" => 6
            ]
        ]);

        $data = $request->validate([
            'play_category' => 'required',
        ]);


        // return ['apple' => 'red', 'peach' => 'pink'];

        // laravel collectionの機能を使ってcollectionからランダムに要素を取得
        // https://qiita.com/mikakane/items/76ae73990bf1ece9e7ae
        // https://webty.jp/staffblog/production/post-2184/
        return response()
            ->json($play_all
                ->where('play_category', $data['play_category'])
                ->random(1));
    }
}
