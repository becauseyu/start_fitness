<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Goodsdetail;
use App\Models\Branddetail;
use App\Models\Member;

use Illuminate\Support\Facades\Session;


class LdGoodsController extends Controller
{
    // 商品總攬
    function list()
    {

        // 管理員驗證
        //會員身分驗證
        $text = (object) [];
        $text->title = '會員管理';
        $compact_var = ['text'];
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                if ((new Member)->isController($acc)) {
                    $text->memberStatus = true;
                    array_push($compact_var, 'member');
                } else {
                    return redirect('/ld/login');
                }
            } else {
                $text->memberStatus = false;
                return redirect('/ld/login');
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
            return redirect('/ld/login');
        }
        //------------------------------------------------------


        $goodsList = Goodsdetail::where('ppic', 'like', '%00%')->where('staid','!=','2')->paginate(15);
        foreach ($goodsList as $goods) {
            $goods->url = url('/') . '/image/' . $goods->ptype . '/' . $goods->ppic;
            foreach ($goods->flavor as $flavor) {
                $flavor->url = url('/') . '/image/' . $flavor->ptype . '/' . $flavor->ppic;
            }
        }


        return view('ld.goods.list', compact('goodsList'));
    }


    // 撈品牌資料
    function brandList()
    {
        $brandList = Branddetail::all()->toArray();
        return $brandList;
    }

    // 撈大分類資料
    function ptypeList()
    {
        $ptypeList =  Goodsdetail::groupBy('ptype')->get('ptype')->toArray();
        return $ptypeList;
    }



    // 大項編輯
    function bigEdit(Request $request)
    {
        // 管理員驗證
        //會員身分驗證
        $text = (object) [];
        $text->title = '會員管理';
        $compact_var = ['text'];
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                if ((new Member)->isController($acc)) {
                    $text->memberStatus = true;
                } else {
                    return redirect('/ld/login');
                }
            } else {
                $text->memberStatus = false;
                return redirect('/ld/login');
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
            return redirect('/ld/login');
        }
        //------------------------------------------------------






        // 撈到 pid 、 pname 、 ptype 、 bid
        $pid = $request->input('pid');
        $new_pname = $request->input('pname');
        $new_ptype = $request->input('ptype');
        $new_bid = $request->input('bid');

        $goods_first = Goodsdetail::find($pid);
        $old_pname = $goods_first->pname;
        $old_ptype = $goods_first->ptype;
        $old_bid = $goods_first->bid;


        $goodsList = Goodsdetail::where('pname', $old_pname)->where('ptype', $old_ptype)->where('bid', $old_bid)->get();

        // 檢查資料有沒有不同
        $isUpdate = 0;

        if ($new_pname != $old_pname) {
            foreach ($goodsList as $goods) {
                $goods->pname = $new_pname;
                $isUpdate = 1;
            }
        }

        if ($new_bid != $old_bid) {
            foreach ($goodsList as $goods) {
                $goods->bid = $new_bid;
                $isUpdate = 1;
            }
        }

        if ($new_ptype != $old_ptype) {
            foreach ($goodsList as $goods) {
                $goods->ptype = $new_ptype;
                $isUpdate = 1;
            }
        }


        // 如果有改動就儲存
        if ($isUpdate) {
            foreach ($goodsList as $goods) {
                $goods->save();
            }
        }

        // 完成後跳轉回去
        return redirect('/ld/goods/list');
    }


    // 小項編輯
    function smallEdit(Request $request)
    {
           // 管理員驗證
        //會員身分驗證
        $text = (object) [];
        $text->title = '會員管理';
        $compact_var = ['text'];
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                if ((new Member)->isController($acc)) {
                    $text->memberStatus = true;
                } else {
                    return redirect('/ld/login');
                }
            } else {
                $text->memberStatus = false;
                return redirect('/ld/login');
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
            return redirect('/ld/login');
        }
        //------------------------------------------------------






        // 撈到 pid 、 pstyle 、 pcount 、 pprice
        $pid = $request->input('pid');
        $new_pstyle = $request->input('pstyle');
        $new_pcount = $request->input('pcount');
        $new_pprice = $request->input('pprice');

        $goods = Goodsdetail::find($pid);
        $old_pstyle = $goods->pstyle;
        $old_pcount = $goods->pcount;
        $old_pprice = $goods->pprice;


        // 檢查資料有沒有不同
        $isUpdate = 0;

        if ($new_pstyle != $old_pstyle) {
                $goods->pstyle = $new_pstyle;
                $isUpdate = 1;
        }

        if ($new_pcount != $old_pcount) {
                $goods->pcount = $new_pcount;
                $isUpdate = 1;
        }

        if ($new_pprice != $old_pprice) {
                $goods->pprice = $new_pprice;
                $isUpdate = 1;
        }


        // 檢查有沒有圖片
        if($request->file('file'.$pid)) {
            // 有的話搬移
            $img = $request->file('file'.$pid);
            $imgName = $img->getClientOriginalName();
            $imgPath = '/image/'.$goods->ptype; 
            $img->move(public_path($imgPath), $imgName);

            $goods->ppic = $imgName;
            $isUpdate = 1;
        }
        
       



        // 如果有改動就儲存
        if ($isUpdate) {
                $goods->save();
        }

        // 完成後跳轉回去
        return redirect('/ld/goods/list');
    }






    // 上架
    function onShelf(Request $request)
    {

        // 管理員驗證
        //會員身分驗證
        $text = (object) [];
        $text->title = '會員管理';
        $compact_var = ['text'];
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                if ((new Member)->isController($acc)) {
                    $text->memberStatus = true;
                } else {
                    return redirect('/ld/login');
                }
            } else {
                $text->memberStatus = false;
                return redirect('/ld/login');
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
            return redirect('/ld/login');
        }
        //------------------------------------------------------
        $pid = $request->id;
        $goods_first = Goodsdetail::find($pid);
        $pname = $goods_first->pname;
        $ptype = $goods_first->ptype;
        $bid = $goods_first->bid;


        $goodsList = Goodsdetail::where('pname', $pname)->where('ptype', $ptype)->where('bid', $bid)->where('staid','0')->get();

        foreach ($goodsList as $goods) {
            $goods->staid = 1;
            $goods->save();
        }

        // 完成後跳轉回去
        return redirect('/ld/goods/list');
    }

    // 下架
    function takeDown(Request $request)
    {

        // 管理員驗證
        //會員身分驗證
        $text = (object) [];
        $text->title = '會員管理';
        $compact_var = ['text'];
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                if ((new Member)->isController($acc)) {
                    $text->memberStatus = true;
                } else {
                    return redirect('/ld/login');
                }
            } else {
                $text->memberStatus = false;
                return redirect('/ld/login');
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
            return redirect('/ld/login');
        }
        //------------------------------------------------------
        $pid = $request->id;
        $goods_first = Goodsdetail::find($pid);
        $pname = $goods_first->pname;
        $ptype = $goods_first->ptype;
        $bid = $goods_first->bid;


        $goodsList = Goodsdetail::where('pname', $pname)->where('ptype', $ptype)->where('bid', $bid)->where('staid','1')->get();

        foreach ($goodsList as $goods) {
            $goods->staid = 0;
            $goods->save();
        }

        // 完成後跳轉回去
        return redirect('/ld/goods/list');
    }


    // 多項刪除
    function deleteAll(Request $request)
    {

        // 管理員驗證
        //會員身分驗證
        $text = (object) [];
        $text->title = '會員管理';
        $compact_var = ['text'];
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                if ((new Member)->isController($acc)) {
                    $text->memberStatus = true;
                } else {
                    return redirect('/ld/login');
                }
            } else {
                $text->memberStatus = false;
                return redirect('/ld/login');
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
            return redirect('/ld/login');
        }
        //------------------------------------------------------
        $pid = $request->id;
        $goods_first = Goodsdetail::find($pid);
        $pname = $goods_first->pname;
        $ptype = $goods_first->ptype;
        $bid = $goods_first->bid;


        $goodsList = Goodsdetail::where('pname', $pname)->where('ptype', $ptype)->where('bid', $bid)->get();

        foreach ($goodsList as $goods) {
            $goods->staid = 2;
            $goods->save();
        }

        // 完成後跳轉回去
        return redirect('/ld/goods/list');
    }


    // 單項刪除
    function deleteOne(Request $request)
    {

        // 管理員驗證
        //會員身分驗證
        $text = (object) [];
        $text->title = '會員管理';
        $compact_var = ['text'];
        // 會員驗證----------------------------------------------------
        try {
            $acc = Session::get('account');
            $verify = Session::get('verify');

            $member = Member::where('account', $acc)->first();
            if (md5($member->psw . $acc) == $verify) {
                if ((new Member)->isController($acc)) {
                    $text->memberStatus = true;
                } else {
                    return redirect('/ld/login');
                }
            } else {
                $text->memberStatus = false;
                return redirect('/ld/login');
            }
        } catch (\Throwable $th) {
            $text->memberStatus = false;
            return redirect('/ld/login');
        }
        //------------------------------------------------------
        $pid = $request->id;
        $goods = Goodsdetail::find($pid);
        
            $goods->staid = 2;
            $goods->save();

        // 完成後跳轉回去
        return redirect('/ld/goods/list');
    }






}
