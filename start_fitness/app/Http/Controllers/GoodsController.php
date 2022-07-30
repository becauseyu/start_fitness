<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Goodsdetail;
use App\Models\Branddetail;
use App\Models\Member;

use Illuminate\Support\Facades\Session;

class GoodsController extends Controller
{
    // 商品總攬
    function index()
    {
        $text = (object) [];
        $text->title = 'goods_index';
        $compact_var = ['text'];



        //會員身分驗證
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                $text->memberStatus = true;
                array_push($compact_var, 'member');
            } else {
                $text->memberStatus = false;
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
        }





        // 撈資料庫

        try {
            // 20220727 新增過濾下架功能
            // 以下舊寫法
            // $foodList = Goodsdetail::where('ptype', 'food')->where('ppic', 'like', '%00%')->where('staid', '1')->get();
            // $gymList = Goodsdetail::where('ptype', 'gym')->where('ppic', 'like', '%00%')->where('staid', '1')->get();

            // 20220730 改動過濾資料方法(以上是舊寫法，以下新血法)
            $foodNameList = Goodsdetail::where('ptype', 'food')->groupBy('pname')->orderBy('pid')->get('pname');
            $foodList = [];

            foreach($foodNameList as $key => $foodName){
                $temp = Goodsdetail::where('pname',$foodName->pname)->where('staid','1')->get();
                
                if(count($temp) > 0){
                    $foodList[$key] = $temp[0];
                    $foodList[$key]->url = '/image/'.$temp[0]->ptype.'/'.$temp[0]->ppic;

                    if (count($temp) > 1){
                        $foodList[$key]->hover = '/image/'.$temp[1]->ptype.'/'.$temp[1]->ppic;

                    }else{
                        $foodList[$key]->hover = $foodList[$key]->url;
                    }

                }
            }


            $gymNameList = Goodsdetail::where('ptype', 'gym')->groupBy('pname')->orderBy('pid')->get('pname');
            $gymList = [];

            foreach($gymNameList as $key => $gymName){
                $temp = Goodsdetail::where('pname',$gymName->pname)->where('staid','1')->get();
                
                if(count($temp) > 0){
                    $gymList[$key] = $temp[0];
                    $gymList[$key]->url = '/image/'.$temp[0]->ptype.'/'.$temp[0]->ppic;



                    if (count($temp) > 1){
                        $gymList[$key]->hover = '/image/'.$temp[1]->ptype.'/'.$temp[1]->ppic;

                    }else{
                        $gymList[$key]->hover = $gymList[$key]->url;
                    }
                }

            }




        } catch (\Throwable $th) {

            // 資料庫死掉的時候不會出錯
            $foodList = (object) [];
            $gymList  = (object) [];
            dd('so sad');
        }
        array_push($compact_var, 'foodList', 'gymList');
        return view('goods.index', compact($compact_var));
    }


    // 商品細項
    function data(Request $request)
    {
        $text = (object) [];
        $text->title = 'saleDetail';


        // 撈出單筆
        if (isset($request->pid)) {

            $pid = $request->pid;

            try {
                $good = Goodsdetail::find($pid);

                // 確定有撈到資料
                if (!$good->pname) {
                    //撈不到資料，跳轉
                    redirect('/goods/index');
                }
            } catch (\Throwable $th) {
                //撈不到資料，跳轉
                redirect('/goods/index');
            }
        } else {
            //網址沒有帶號碼，跳轉
            redirect('/goods/index');
        }



        // 抓flavor 資料 // 20220727 新增過濾下架功能
        $flavorList_img = Goodsdetail::where('pname', $good->pname)->where('staid', '1')->get();
        $flavorList_btn = Goodsdetail::where('pname', $good->pname)->where('staid', '1')->groupBy('pstyle')->get();





        return view('goods.data', compact('text', 'good', 'flavorList_img', 'flavorList_btn'));
    }


    // 取得隨機商品頁(給用minigame用)
    function getRandomGoods(Request $request)
    {
        $text = (object) [];
        $text->title = 'goods_index';
        $compact_var = ['text'];



        //會員身分驗證
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                $text->memberStatus = true;
                array_push($compact_var, 'member');
            } else {
                $text->memberStatus = false;
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
        }



        // 隨機產生變數
        $idList = Goodsdetail::where('ptype', 'food')->where('staid', 1)->get('pid');
        $rand = rand(0, count($idList) - 1);
        // dd($rand);

        $goods = Goodsdetail::find($idList[$rand]->pid);


        // 必要東西打包，其他不要給出去
        $data = (object) [];
        $data->pname = $goods->pname;
        $data->ppic =  '/image/' . $goods->ptype . '/' . $goods->ppic;
        $data->href = '/goods/data/' . $goods->pid;

        return $data;
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





// 撈出細項資料
// include('./mysqli.php');

// $goods = $_REQUEST['pid'];
// if (isset($goods)) {
//   //取得商品資訊
//   $sql = "SELECT * FROM goodsdetail INNER JOIN branddetail on goodsdetail.bid = branddetail.bid WHERE pid = '$goods'";
//   $result = $mysqli->query($sql);
//   $row = $result->fetch_object();
// } else {
//   header("Location:goods_index.php");
// }

// $sql_flavor = "SELECT * FROM goodsdetail WHERE pname ='{$row->pname}'";
//           $result_flavor = $mysqli->query($sql_flavor);