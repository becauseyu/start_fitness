<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branddetail extends Model
{
    use HasFactory;
    protected $table = "branddetail";                  // 連動對應表單名稱
    protected $primaryKey = 'bid';                     // primaryKey
    public $timestamps = false;
    protected $fillable = ['bname'];
}
