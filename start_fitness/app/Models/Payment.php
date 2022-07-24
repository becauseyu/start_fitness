<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = "payment";                  // 連動對應表單名稱
    protected $primaryKey = 'paid';                     // primaryKey
    public $timestamps = false;
    protected $fillable = ['payment'];


}
