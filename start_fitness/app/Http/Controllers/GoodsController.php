<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goodsdetail;
use App\Models\Branddetail;

class GoodsController extends Controller
{
    function index() {
        $text = (object) [];
        $text->title = 'goods_index';
        // 撈資料庫


        $foodList = Goodsdetail::where('ptype','food')->where('ppic','like','%00%')->get();
        $gymList = Goodsdetail::where('ptype','gym')->where('ppic','like','%00%')->get();
        return view('goods.index',compact('text','foodList','gymList'));
    }
}





//從資料庫取出產品放到畫面
// include('./mysqli.php');

// $sql_f = "SELECT * FROM goodsdetail WHERE ptype = 'food' AND ppic LIKE '%00%' ";
// $resultFood = $mysqli->query($sql_f);

// $sql_g = "SELECT * FROM goodsdetail WHERE ptype = 'gym' AND ppic LIKE '%00%'";
// $resultGym = $mysqli->query($sql_g);


// $sql = "SELECT bname FROM branddetail WHERE bid = '{$good->bid}' ";
//                 $result = $mysqli->query($sql);
//                 $row = $result->fetch_array();



