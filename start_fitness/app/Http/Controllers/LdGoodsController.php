<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Goodsdetail;
use App\Models\Branddetail;
use App\Models\Log;
use App\Models\Member;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

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
        // $goodsList = Goodsdetail::where('ppic', 'like', '%00%')->where('staid', '!=', '2')->paginate(15);

        $goodsNameList =  Goodsdetail::where('staid', '!=', '2')->groupBy('pname')->orderBy('pid','desc')->paginate(15);
        $goodsList = [];
        foreach ($goodsNameList as $key => $goodsName) {
            $temp = Goodsdetail::where('pname', $goodsName->pname)->where('staid','!=', '2')->first();

            if (!is_null($temp)) {
                $goodsList[] = $temp;
            }
        }



        foreach ($goodsList as $goods) {
            $goods->url = url('/') . '/image/' . $goods->ptype . '/' . $goods->ppic;
            foreach ($goods->flavor as $flavor) {
                $flavor->url = url('/') . '/image/' . $flavor->ptype . '/' . $flavor->ppic;
            }
        }


        return view('ld.goods.list', compact('goodsList','goodsNameList'));
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
                
                
                Storage::disk('image')->move('/'.$old_ptype.'/'.$goods->ppic, '/'.$new_ptype.'/'.$goods->ppic);
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
        if ($request->file('file' . $pid)) {
            // 有的話搬移
            $img = $request->file('file' . $pid);
            $imgName = $img->getClientOriginalName();
            $imgPath = '/image/' . $goods->ptype;
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


        $goodsList = Goodsdetail::where('pname', $pname)->where('ptype', $ptype)->where('bid', $bid)->where('staid', '0')->get();

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


        $goodsList = Goodsdetail::where('pname', $pname)->where('ptype', $ptype)->where('bid', $bid)->where('staid', '1')->get();

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


    // 拿到新增表單
    function bigCreateList(Request $request)
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



        // 表單需要 ptype bname
        $brandList = Branddetail::all();
        $ptypeList =  Goodsdetail::groupBy('ptype')->get('ptype');



        return view('ld.goods.create', compact('brandList', 'ptypeList'));
    }


    // 新增表單接收處理
    function bigCreate(Request $request)
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




        // 表單應該要有 單一: ptype pname bid
        //  多列 : pstyle pcount pprice ppic


        $ptype = $request->input('ptype') ?? '';
        $pname = $request->input('pname') ?? '';
        $bid = $request->input('bid') ?? '';

        for ($i = 0; $i < count($request->pstyle); $i++) {
            $pstyle = $request->input('pstyle')[$i] ?? '';
            $pcount = $request->input('pcount')[$i] ?? '';
            $pprice = $request->input('pprice')[$i] ?? '';




            // 檢查有沒有圖片
            if (isset($request->file('file')[$i])) {
                // 有的話搬移
                $img = $request->file('file')[$i];
                $ppic = $img->getClientOriginalName();
                $imgPath = '/image/' . $ptype;
                $img->move(public_path($imgPath), $ppic);
            } else {
                $ppic = '';
            }
            (new Goodsdetail)->createNewGoods($ptype, $bid, $pstyle, $pname, $pcount, $ppic, $pprice);
            (new Log)->writeNewGoods($pname);
        }

        return redirect('/ld/goods/list');
    }


    // 拿到編輯表單(未完成)
    function bigEdit2(Request $request)
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


        $request->id;

        // 表單需要 ptype bname
        $brandList = Branddetail::all();
        $ptypeList =  Goodsdetail::groupBy('ptype')->get('ptype');



        return view('ld.goods.create', compact('brandList', 'ptypeList'));
    }
}
