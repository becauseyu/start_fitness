<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = "member";                  // 連動對應表單名稱
    protected $primaryKey = 'mid';                 // primaryKey
    public $timestamps = false;


    // function department() {
    //     return $this->belongsTo(Departments::class, 'departmentId','departmentId');   //連結表單(對應欄位)  
    // }




    // 帳號驗證
    function accountCheck($account,$password) {
        try{
        $member = $this::where('account', $account)->get('psw');
        if (!$member) {
            return false;
        }
        if ( md5($password) ==$member[0]->psw) {
            return true;
            
        }else{
            return false;
        }
        }
        catch(\Throwable $th) 
        { return false; }
    }


    
}

