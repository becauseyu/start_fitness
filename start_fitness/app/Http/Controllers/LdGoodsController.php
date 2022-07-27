<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Goodsdetail;
use App\Models\Branddetail;

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


    // 撈品牌資料
    function brandList() {
        $brandList = Branddetail::all()->toArray();
        return $brandList;
    }

    // 撈大分類資料
    function ptypeList() {
        $ptypeList =  Goodsdetail::groupBy('ptype')->get('ptype')->toArray();
        return $ptypeList;
    }


}
