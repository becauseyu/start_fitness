<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliver extends Model
{
    use HasFactory;
    protected $table = "deliver";                  // 連動對應表單名稱
    protected $primaryKey = 'did';                     // primaryKey
    public $timestamps = false;
    protected $fillable = ['deliver'];
}
