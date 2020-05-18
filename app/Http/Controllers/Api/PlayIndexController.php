<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayIndexController extends Controller
{
    public function index()
    {
        $play_all = collect([
            [
                "id" =>  1,
                "title" => "どうぶつのもり",
                "src" => "http://img.youtube.com/vi/YO-wTijsPcs/hqdefault.jpg",
                "category" => "game",
                "flex" => 6
            ],
            [
                "id" => 2,
                "title" => "おやつ サーターアンダギー",
                "src" => "http://img.youtube.com/vi/izjA7bqmH3k/hqdefault.jpg",
                "category" => "oyatsu",
                "flex" => 6
            ],
            [
                "id" => 3,
                "title" => "おやつ パンケーキ",
                "src" => "http://img.youtube.com/vi/yvkRI8E5UdY/hqdefault.jpg",
                "category" => "oyatsu",
                "flex" => 6
            ],
            [
                "id" => 4,
                "title" => "おりがみ つる",
                "src" => "http://img.youtube.com/vi/qtP3TmvGUZk/hqdefault.jpg",
                "category" => "",
                "flex" => 6
            ],
            [
                "id" => 5,
                "title" => "おりがみ すいっち",
                "src" => "http://img.youtube.com/vi/GjyJsPMUDTA/hqdefault.jpg",
                "category" => "",
                "flex" => 6
            ], [
                "id" => 6,
                "title" => "おりがみ しゅりけん",
                "src" => "http://img.youtube.com/vi/0_Ex9uXFI_A/hqdefault.jpg",
                "category" => "",
                "flex" => 6
            ], [
                "id" => 7,
                "title" => "なわとび",
                "src" => "http://img.youtube.com/vi/2NNFyE3AtVg/sddefault.jpg",
                "category" => "",
                "flex" => 6
            ], [
                "id" => 8,
                "title" => "からだをうごかす すとらいだー",
                "src" => "http://img.youtube.com/vi/lfQpg0a06XE/sddefault.jpg",
                "category" => "",
                "flex" => 6
            ], [
                "id" => 9,
                "title" => "からだをうごかす さんりんしゃ",
                "src" => "http://img.youtube.com/vi/TWE8cjkNNj0/sddefault.jpg",
                "category" => "",
                "flex" => 6
            ], [
                "id" => 10,
                "title" => "えをかく ぬりえ",
                "src" => "http://img.youtube.com/vi/npad23BoXic/hqdefault.jpg",
                "category" => "",
                "flex" => 6
            ],
            [
                "id" => 11,
                "title" => "うんどうする らじおたいそう",
                "src" => "http://img.youtube.com/vi/jPeHKtiFXIg/hqdefault.jpg",
                "category" => "",
                "flex" => 6
            ],
            [
                "id" => 12,
                "title" => "べんきょうする ひらがな",
                "src" => "http://img.youtube.com/vi/GgKItOVLo8w/hqdefault.jpg",
                "category" => "",
                "flex" => 6
            ],
            [
                "id" => 13,
                "title" => "おやつ アイスクリーム",
                "src" => "https://www.meiji.co.jp/products/icecream/assets/img/4902705125308_product.jpg",
                "category" => "",
                "flex" => 6
            ]



        ]);

        //https://qiita.com/mikakane/items/76ae73990bf1ece9e7ae
        //https://webty.jp/staffblog/production/post-2184/

        // return ['apple' => 'red', 'peach' => 'pink'];

        // laravel collectionの機能を使ってcollectionからランダムに要素を取得
        return response()->json($play_all->random(4));
    }
}
