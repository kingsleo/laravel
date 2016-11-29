<?php
namespace App\Http\Controllers;
use App\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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
    //模板使用
    public function section1(){
        $tasks = Tasks::get();
        //$tasks = [];
        $name = "kingsleo";
        $arr = ['kingsleo','zly'];
        return view('tasks.section1',
            [
                'name'=>$name,
                'arr' => $arr,
                'tasks' => $tasks
            ]
            );
    }
    //模板使用url
    public function urlTest(){
        return "urlTest";
    }
    //Controller操作request
    public function request1(Request $request){
        //取值
        //echo $request->input('name');
        //echo $request->input('sex','未知');
        /*if($request->has('name')){
            echo $request->input('name');
        }else{
            echo "无该参数";
        }*/
        /*$res = $request->all();
        dd($res);*/

        //2.判断请求类型
        //echo $request->method();
        //$bool = $request->isMethod("GET");
        //$bool = $request->ajax();
        $bool = $request->is("task/*");
        var_dump($bool);
    }
    //Controller操作session
    public function session1(Request $request){
        //1.http request session
        //$request->session()->put('key1','value1');
       // echo $request->session()->get('key1');
        //2.session()
        //session()->put('key2','value2');
        //Session::put('key2','value2');
        //3.没有获取到session的值就用后面的默认值
        //echo session()->get('key3','default');
        //echo Session::get('key3','default');
        //用数组存取session
        //Session::put('key4','value4');
        //把数据放到session的数组中
        //Session::push('task','kings');
       // Session::push('task','zly');
        //取出数据并删除
        //$task = Session::pull('task');
        //var_dump($task);
        //只赋值一次session，访问完就删除
        Session::flash('key5','value5');
    }
    public function session2(Request $request){
        return Session::get('message','暂无数据');
        //取出所有的值
        //$arr = Session::all();
        //var_dump($arr);
        //判断是否有值
        /*if(Session::has('key11')){
            $arr = Session::all();
            dd($arr);
        }else{
            echo "值不存在";
        }*/
        //删除一个session
        /*Session::forget('key1');
        $arr = Session::all();
        dd($arr);*/
        //全部删除session
        /*Session::flush();
        $arr = Session::all();
        dd($arr);*/
        //echo Session::get('key5');
    }
    //Controller操作response
    public function response(){
        //转为json格式
        /*$data = [
            'errCode' => 0,
            'errMsg' => 'success',
            'data' => 'kingsleo'
        ];
        return response()->json($data);*/
        //重定向
        //return redirect('session2')->with('message','我是数据')
        //return redirect()->action('TaskController@session2')->with('message','我是数据');
        return redirect()->route('session2')->with('message','我是数据');
    }
    //Controller的middleware
    public function activity0(){
        return '活动即将开始，敬请期待';
    }
    public function activity1(){
        return '活动1开始';
    }
    public function activity2(){
        return '活动2开始';
    }
}