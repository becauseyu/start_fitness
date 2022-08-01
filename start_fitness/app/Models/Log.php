<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Log extends Model
{
    use HasFactory;

    protected $table = "log";                  // 連動對應表單名稱
    protected $primaryKey = 'id';                 // primaryKey
    public $timestamps = false;


    function writeLoginTimes($account,$times) {
        $this->insert([
            'body' => "登入錯誤超過{$times}次以上，帳號 : {$account}"
        ]);
    }

    function writeLoginSuccess($account) {
        $this->insert([
            'body' => "會員登入，帳號 : {$account}"
        ]);
    }


    function writeLoginNewOrder($orderid) {
        $this->insert([
            'body' => "新增訂單，訂單編號 : {$orderid}"
        ]);
    }

    function writeLoginBack($account) {
        $this->insert([
            'body' => "後台登入，帳號 : {$account}"
        ]);
    }

    function writeNewGoods($pname) {
        $this->insert([
            'body' => "新品上架，商品名稱 : {$pname}"
        ]);
    }


}
