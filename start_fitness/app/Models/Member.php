<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Log;
use App\Models\Statusdetail;

class Member extends Model
{
    use HasFactory;

    protected $table = "member";                  // 連動對應表單名稱
    protected $primaryKey = 'mid';                 // primaryKey
    public $timestamps = false;
    protected $fillable = ['account', 'psw', 'name', 'email'];

    // function department() {
    //     return $this->belongsTo(Departments::class, 'departmentId','departmentId');   //連結表單(對應欄位)  
    // }


    // 連結Staid
    function statusdetail() {
        return $this->belongsTo(Statusdetail::class,'staId','staId');
    }

    // 連結log
    function lastLogin($account) {
        try {
            $lastLogin =Log::where('body','like','會員登入%')->where('body','like','%'.$account)->orderBy('id','desc')->first();
            if ($lastLogin) {
                return $lastLogin->date;
            }else{
                return '尚無登入';
            }
            
        } catch (\Throwable $th) {
            return '尚無登入';
        }
        return Log::where('body','like','會員登入%')->where('body','like','%'.$account)->last();
    }

    // 用帳號驗證
    function accountCheck($account, $password)
    {
        try {
            $member = $this::where('account', $account)->get('psw');
            if (!$member) {
                return false;
            }
            if (md5($password) == $member[0]->psw) {
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }


    // 用id+密碼拿到資料
    function idGet($id, $password)
    {
        try {
            $member = $this::find($id);
            if (!$member) {
                return false;
            }
            if ($password == $member->psw) {
                return $member;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }

    // 會員開通
    public function accountOpen($id, $verify)
    {

        try {
            $member = $this::find($id);
            if (!$member) {
                return false;
            }
            if ($verify == $member->psw) {
                $member->staId = 2;
                $member->save();
                return true;
            } else {
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }


    // 加入新會員
    function createNewMember($acc, $psw, $realName, $email)
    {
        try {

            $member = $this::create([
                'account' => $acc,
                'psw' => $psw,
                'name' => $realName,
                'email' => $email
            ]);
            return $member;
        } catch (\Throwable $th) {
            return false;
        }
    }


    // 忘記密碼找信箱
    function searchEmail($email)
    {
        try {

            $member = $this::where('email', $email)->first();
            return $member;
        } catch (\Throwable $th) {
            return false;
        }
    }



    // 管理員驗證
    function isController($account){
        try {
            
            $member = $this::where('account',$account)->first();
            if ($member->statusdetail->staName == '管理員') {
                return $member;
            }else{
                return false;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
    //會員訂單
    function memberOrder(){
        return $this->hasMany(Memberorder::class,'mid','mid');
    }
}
