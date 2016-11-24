<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model{
    //指定表名
    protected $table = "tasks";
    //指定id作为主键
    protected $primaryKey = "id";
    //指定批量新增字段
    protected $fillable = ['name','age'];
    //指定不允许批量新增字段
    protected $guarded = [];
    //设置时间戳
    public $timestamps = true;
     protected function getDateFormat()
     {
         return time();
     }
    protected function asDateTime($value)
    {
        return $value;
    }

}