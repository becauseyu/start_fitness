<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Goodsdetail;

class LdGoodsController extends Controller
{
    function list() {
        return view('ld.goods.list');
    }
}
