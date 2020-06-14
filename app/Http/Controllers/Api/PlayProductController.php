<?php

namespace App\Http\Controllers\Api;

use App\PlayProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlayProductController extends Controller
{
    public function index()
    {
        return PlayProduct::all();
    }

    public function show($id, Request $request)
    {
        return PlayProduct::findOrFail($id);
    }
}
