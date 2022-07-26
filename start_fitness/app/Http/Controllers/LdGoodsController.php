<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Goodsdetail;

class LdGoodsController extends Controller
{
    // 商品總攬
    function list() {

    $goodsList = Goodsdetail::where('ppic','like','%00%')->paginate(15);

    foreach ($goodsList as $goods) {
        $goods->url = url('/').'/image/'.$goods->ptype.'/'.$goods->ppic;
        foreach ($goods->flavor as $flavor) {
            $flavor->url =url('/').'/image/'.$flavor->ptype.'/'.$flavor->ppic;
        }
        
    }


        return view('ld.goods.list',compact('goodsList'));
    }
}
