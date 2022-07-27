<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDeatail extends Model
{
    use HasFactory;
    protected $table = "orderdetail";                  // 連動對應表單名稱
    protected $primaryKey = 'opid';                     // primaryKey
    public $timestamps = false;
    protected $fillable = ['oid','pid','amount'];

    function createNewOrderDetail($oid,$pid,$count)
    {
        try {

            $OrderDetail = $this::create([
                'oid' => $oid,
                'pid' => $pid,
                'amount' => $count,
            ]);
            return $OrderDetail;
        } catch (\Throwable $th) {
            return false;
        }
    }


}
