<?php
namespace App\Http\Controllers;
use App\Tasks;
use Illuminate\Support\Facades\DB;
class TaskController extends Controller{
    public function test1(){
        //$arr = DB::select("select * from tasks");
        $arr = DB::insert('insert into tasks(name) VALUES(?)',['zly']);
        var_dump($arr);
    }
    //使用查询构造器增加数据
    public function query1(){
        /*$bool = DB::table('tasks')->insert(
            ['name' => 'aaa']
        );*/
        $bool = DB::table("tasks")->insert(
            ['name' => 'ccc'],
            ['name' => 'ddd']
        );
        var_dump($bool);
    }
    //使用查询构造器更新数据
    public function query2(){
            /*$num = DB::table("tasks")
                ->where('id',6)
                ->update(['name' => 'bbb1']);*/
            //$num = DB::table("tasks")->increment('age',3);
            //$num = DB::table("tasks")->decrement('age',3);
            $num = DB::table("tasks")
                ->where('id',6)
                ->increment('age',1,['name'=>'bbb']);
            var_dump($num);
    }
    //使用查询构造器删除数据
    public function query3(){
        $num = DB::table("tasks")
            ->where('id','>=',5)
            ->delete();
        var_dump($num);
    }
    //使用查询构造器查询数据
    public function query4(){
        //$arr = DB::table("tasks")->get();
        /*$arr = DB::table("tasks")
            ->orderBy('id','desc')
            ->first();*/
        /*$arr = DB::table("tasks")
            ->whereRaw('id >= ? and age >?',[2,3])
            ->get();*/
        //$arr = DB::table("tasks")->pluck("name");
        //$arr = DB::table("tasks")->lists("name","id");
        /*$arr = DB::table("tasks")
            ->select("name","id","age")
            ->get();*/
        $arr = DB::table("tasks")->chunk(2,function($arr){
            var_dump($arr);
        });
        //var_dump($arr);
    }
    //使用ORM查询数据
    public function orm1(){
        //all()
        //$arr = Tasks::all();
        //find()
        //$arr = Tasks::find(2);
        //findOrFail()
        //$arr = Tasks::findOrFail(3);
        //get()
        //$arr = Tasks::get();
        //get()加条件排序,取第一条
        /*$arr = Tasks::where('id','>','2')
            ->orderBy('id','desc')
            ->first();*/
        //chunk()
        /*$arr = Tasks::chunk(2,function($arr){
            var_dump($arr);
        });*/
        //聚合函数
        //$arr  = Tasks::count();
        $arr = Tasks::where('id','>',2)->max('age');
        dd($arr);
    }
    //使用ORM新增数据
    public function orm2(){
        //使用模型新增
       /* $tasks = new Tasks();
        $tasks->name = 'ddd';
        $bool = $tasks->save();*/
        /*$arr = Tasks::find(11);
        echo $arr->created_at;*/
        //使用模型create新增
       /* $tasks = Tasks::create(
            ['name'=>'rrr','age'=>10]
        );
        var_dump($tasks);*/
        //firstOrCreate()
        /*$tasks = Tasks::firstOrCreate(
            ['id'=>'24']
        );
        var_dump($tasks);*/
        //firstOrNew()
        $tasks = Tasks::firstOrNew(
            ['name'=>'rrr2']
        );
        $bool = $tasks->save();
        var_dump($bool);
        //var_dump($bool);
    }
    //使用ORM修改数据
    public function orm3(){
        /*$tasks = Tasks::find(14);
        $tasks->name = "rrr2";
        $bool = $tasks->save();
        var_dump($bool);*/
        $num = Tasks::where("id",">","12")->update(
            ['age'=>20]
        );
        var_dump($num);
    }
    //使用ORM删除数据
    public function orm4(){
        //使用模型删除
        /*$tasks = Tasks::find(15);
        $bool = $tasks->delete();
        var_dump($bool);*/
        //通过主键删除
        /*$num = Tasks::destroy([10,11]);
        var_dump($num);*/
        //通过构造器删除
        $num = Tasks::where('id','>',8)->delete();
        var_dump($num);
    }
}