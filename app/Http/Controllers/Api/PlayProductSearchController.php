<?php

namespace App\Http\Controllers\Api;

use App\PlayProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayProductSearchController extends Controller
{
    public function show(Request $request)
    {
        $data = $request->validate(
            [
                'category' => 'required',
            ]
        );

        return PlayProduct::where('category', $data['category'])
            ->get()
            ->random(1);
    }
}
