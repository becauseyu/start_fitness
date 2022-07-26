<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Goodsdetail;

class LdGoodsController extends Controller
{
    // 商品總攬
    function list() {

    $goodsList = Goodsdetail::where('ppic','like','%00%')->paginate(15);


        return view('ld.goods.list',compact('goodsList'));
    }
}
