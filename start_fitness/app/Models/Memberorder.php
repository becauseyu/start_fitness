<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memberorder extends Model
{
    use HasFactory;
    protected $table = "memberorder";                  // 連動對應表單名稱
    protected $primaryKey = 'oid';                     // primaryKey
    public $timestamps = false;
    protected $fillable = ['mid','orderdate','delAddr','delTel','delName','did','paid','memo','total'];


//     "INSERT INTO memberorder(mid,orderdate,delAddr,delTel,delName,did,paid,memo) VALUES
// //      ('{$mid}','{$date}','{$del_addr}','{$del_tel}','{$del_name}','{$deliver_method}','{$pay_method}','{$memo}')";
// //         $mysqli->query($sql_addOrder);

     // 加入新訂單
     function createNewOrder($memberId, $date, $address, $tel ,$name, $did ,$paid ,$memo)
     {
         try {
 
             $order = $this::create([
                 'mid' => $memberId,
                 'orderdate' => $date,
                 'delAddr' => $address,
                 'delTel' => $tel,
                 'delName' => $name,
                 'did' => $did,
                 'paid' => $paid,
                 'memo' => $memo

             ]);
             return $order;
         } catch (\Throwable $th) {
             return $th;
         }
     }

}
