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

    // 
    public function flavor(){
        return $this->hasMany(Goodsdetail::class,'pname','pname');
    }
        
}
