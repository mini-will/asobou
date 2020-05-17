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

        $play_all = array([
            [
                "id" =>  1,
                "title" => "どうぶつのもり",
                "src" => "http://img.youtube.com/vi/YO-wTijsPcs/hqdefault.jpg",
                "flex" => 6
            ],
            [
                "id" => 2,
                "title" => "おやつ",
                "src" => "http://img.youtube.com/vi/izjA7bqmH3k/hqdefault.jpg",
                "flex" => 6
            ],
            [
                "id" => 3,
                "title" => "おやつ3",
                "src" => "http://img.youtube.com/vi/izjA7bqmH3k/hqdefault.jpg",
                "flex" => 6
            ],
        ]);

        // return ['apple' => 'red', 'peach' => 'pink'];
        // return [$hello_array];
        // return [$play_all];
        return response()->json($play_all);
    }
}
