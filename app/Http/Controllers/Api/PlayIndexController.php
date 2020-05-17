<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayIndexController extends Controller
{
    public function index()
    {
        $hello = 'Hello,World!';
        $hello_array = ['Hello', 'こんにちは', 'ニーハオ'];

        $play_all = ([
            [
                "id" =>  1,
                "title" => "どうぶつのもり",
                "src" => "http://img.youtube.com/vi/YO-wTijsPcs/hqdefault.jpg",
                "flex" => 6
            ],
            [
                "id" => 2,
                "title" => "おやつ サーターアンダギー",
                "src" => "http://img.youtube.com/vi/izjA7bqmH3k/hqdefault.jpg",
                "flex" => 6
            ],
            [
                "id" => 3,
                "title" => "おやつ パンケーキ",
                "src" => "http://img.youtube.com/vi/yvkRI8E5UdY/hqdefault.jpg",
                "flex" => 6
            ],
            [
                "id" => 4,
                "title" => "おりがみ つる",
                "src" => "http://img.youtube.com/vi/qtP3TmvGUZk/hqdefault.jpg",
                "flex" => 6
            ],
            [
                "id" => 5,
                "title" => "おりがみ すいっち",
                "src" => "http://img.youtube.com/vi/GjyJsPMUDTA/hqdefault.jpg",
                "flex" => 6
            ], [
                "id" => 6,
                "title" => "おりがみ しゅりけん",
                "src" => "http://img.youtube.com/vi/0_Ex9uXFI_A/hqdefault.jpg",
                "flex" => 6
            ], [
                "id" => 7,
                "title" => "なわとび",
                "src" => "http://img.youtube.com/vi/2NNFyE3AtVg/sddefault.jpg",
                "flex" => 6
            ], [
                "id" => 8,
                "title" => "からだをうごかす すとらいだー",
                "src" => "http://img.youtube.com/vi/lfQpg0a06XE/sddefault.jpg",
                "flex" => 6
            ], [
                "id" => 9,
                "title" => "からだをうごかす さんりんしゃ",
                "src" => "http://img.youtube.com/vi/TWE8cjkNNj0/sddefault.jpg",
                "flex" => 6
            ], [
                "id" => 10,
                "title" => "えをかく ぬりええええええ",
                "src" => "http://img.youtube.com/vi/npad23BoXic/hqdefault.jpg",
                "flex" => 6
            ]
        ]);

        // return ['apple' => 'red', 'peach' => 'pink'];
        // return [$hello_array];
        // return [$play_all];
        return response()->json($play_all);
    }
}
