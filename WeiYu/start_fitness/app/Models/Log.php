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
}
