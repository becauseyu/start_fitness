<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;
use App\Models\Branddetail;

class Goodsdetail extends Model
{
    use HasFactory;

    protected $table = "goodsdetail";                  // 連動對應表單名稱
    protected $primaryKey = 'pid';                     // primaryKey
    public $timestamps = false;
    protected $fillable = ['ptype','bid','pstyle','pname','pcount','ppic','pprice'];


    // 連動品牌
    public function branddetail()
    {
        return $this->belongsTo(Branddetail::class, 'bid', 'bid');
    }

    // 撈同名口味
    public function flavor(){
        return $this->hasMany(Goodsdetail::class,'pname','pname');
    }

    // 創建新商品
    function createNewGoods($ptype,$bid,$pstyle,$pname,$pcount,$ppic,$pprice) {
        {
            try {
    
                $goods = $this::create([
                    'ptype' => $ptype,
                    'bid' => $bid,
                    'pstyle' => $pstyle,
                    'pname' => $pname,
                    'pcount' => $pcount,
                    'ppic' => $ppic, 
                    'pprice' => $pprice
                ]);
                return $goods;
            } catch (\Throwable $th) {
                return false;
            }
        }
    }



        
}
