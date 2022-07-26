<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inbody extends Model
{
    protected $table = "inbody";                  // 連動對應表單名稱
    protected $primaryKey = 'id';                     // primaryKey
    public $timestamps = false;
    protected $fillable = ['name', 'tel', 'email', 'gym', 'date', 'time'];




    // 加入新預約
    function createNewInbody($name, $tel, $email, $gym, $date, $time)
    {
        try {

            $inbody = $this::create([
                'name' => $name,
                'tel' => $tel,
                'email' => $email,
                'gym' => $gym,
                'date' => $date,
                'time' => $time

            ]);
            return $inbody;
        } catch (\Throwable $th) {
            return  false;
        }
    }
}
