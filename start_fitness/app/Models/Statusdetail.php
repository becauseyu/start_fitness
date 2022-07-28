<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statusdetail extends Model
{
    use HasFactory;
    protected $table = "statusdetail";                  // 連動對應表單名稱
    protected $primaryKey = 'staId';                     // primaryKey
    public $timestamps = false;
    protected $fillable = ['staName'];

}
