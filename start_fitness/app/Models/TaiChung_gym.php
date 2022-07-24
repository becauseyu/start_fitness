<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaiChung_gym extends Model
{
    use HasFactory;
    protected $table = "taiChung_gym";                  // 連動對應表單名稱
    protected $primaryKey = 'id';                     // primaryKey
    public $timestamps = false;
    protected $fillable = ['name','town','addr','open','tel','lon','lat','pic','intr','res'];
    

}
