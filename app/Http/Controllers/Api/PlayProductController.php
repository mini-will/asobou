<?php

namespace App\Http\Controllers\Api;

use App\PlayProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayProductController extends Controller
{
    public function index(Request $request)
    {
        $data = $request->validate(
            [
                'category' => 'nullable',
                'old' => 'nullable',
                'teppan' => 'nullable',
                'random' => 'nullable'
            ]
        );

        $randomNumber = null;

        // Laravelでさまざまな条件でデータを絞り込む方法
        // https://www.willstyle.co.jp/blog/1116/
        if ($data != null) {
            $query = PlayProduct::query();

            foreach ($data as $key => $value) {
                switch ($key) {
                    case 'category':
                        $query->where('category', $data['category']);
                        break;
                    case 'old':
                        $query->where('recommend_min_age', '<=', $data['old']);
                        $query->where('recommend_max_age', '>', $data['old']);
                        break;
                    case 'random':
                        $randomNumber = $data['random'];
                }
            }

            // ランダム取得数が検索条件にあればランダム数分を返却する
            if ($randomNumber !== null) {
                return response()->json($query->get()->random($data['random']));
            } else {
                return response()->json($query->get());
            }
        }

        // 検索条件が指定されていないときは全件を返却する
        return response()
            ->json(PlayProduct::all());
    }

    public function show($id, Request $request)
    {
        return response()
            ->json(PlayProduct::findOrFail($id));
    }
}
