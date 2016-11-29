<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

Class Student extends Model{

    const SEX_UN = 10;  //未知
    const SEX_BOY = 20;  //男
    const SEX_GRIL = 30;  //女

    protected $table = "student";
    public $timestamps = true;
    protected $fillable = ['name','age','sex'];
    protected function getDateFormat()
    {
        return time();
    }
    protected function asDateTime($value)
    {
        return $value;
    }
    public function sex($ind=null){
        $arr = [
            self::SEX_UN => '未知',
            self::SEX_BOY => '男',
            self::SEX_GRIL => '女'
        ];
        if($ind!==null){
            return array_key_exists($ind,$arr) ? $arr[$ind] : $arr[self::SEX_UN];
        }
        return $arr;
    }
}