<?php
namespace App\Http\Middleware;
use Closure;
class Activity{
    //前置操作
    /*public function handle($request,Closure $next){
        if(time() < strtotime('2016-11-21')){
            return redirect('activity0');
        }
        return $next($request);
    }*/

    //后置操作
    public function handle($request,Closure $next){
        $response = $next($request);
        echo $response;
        echo "我是后置操作";
    }
}