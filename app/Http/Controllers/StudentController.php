<?php
namespace App\Http\Controllers;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Mail\MailServiceProvider;
use Illuminate\Support\Facades\Cache;
use Mail;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller{
    public function index(){
        $students = Student::paginate(10);
        return view("student.index",[
            'students' => $students
        ]);
    }

    public function create(Request $request){
        $student = new Student();
        if($request->isMethod('post')){
            //1.控制器验证
            /*$this->validate($request,[
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ],[
                'Student.name' =>'姓名',
                'Student.age' =>'年龄',
                'Student.sex' =>'性别',
            ]);*/
            //2.validator类验证
            $validator = \Validator::make($request->input(),[
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ],[
                'Student.name' =>'姓名',
                'Student.age' =>'年龄',
                'Student.sex' =>'性别',
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('Student');
            if(Student::create($data)){
                return redirect('student/index')->with('success','提交成功');
            }else{
                return redirect()->back();
            }
        }
        return view('student.create',[
            'student' => $student
        ]);
    }

    public function save(Request $request){
        $data = $request->input('Student');
        $student = new Student();
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];
        if($student->save()){
            return redirect('student/index');
        }else{
            return redirect()->back();
        }
    }

    public function update(Request $request,$id){
        $student = Student::find($id);
        if($request->isMethod('post')){
            $this->validate($request,[
                'Student.name' => 'required|min:2|max:20',
                'Student.age' => 'required|integer',
                'Student.sex' => 'required|integer',
            ],[
                'required' => ':attribute 为必填项',
                'min' => ':attribute 长度不符合要求',
                'integer' => ':attribute 必须为整数',
            ],[
                'Student.name' =>'姓名',
                'Student.age' =>'年龄',
                'Student.sex' =>'性别',
            ]);
            $data = $request->input('Student');
            $student->name = $data['name'];
            $student->sex = $data['sex'];
            $student->age = $data['age'];
            if($student->save()){
                return redirect('student/index')->with('success','修改成功');
            }else{
                return redirect()->back();
            }
        }
        return view('student.update',[
            'student' => $student
        ]);
    }

    public function detail($id){
        $student = Student::find($id);
        return view('student.detail',[
            'student' => $student
        ]);
    }

    public function delete($id){
        $student = Student::find($id);
        if($student->delete()){
            return redirect('student/index')->with('success','删除成功');
        }else{
            return redirect('student/index')->with('error','删除失败');
        }
    }

    public function upload(Request $request){
        if($request->isMethod('post')){
            $file = $request->file('file');
            //文件是否上传成功
            if($file->isValid()){
                //原文件名
                $originalName = $file->getClientOriginalName();
                //扩展名
                $ext = $file->getClientOriginalExtension();
                //Mimetype
                $type = $file->getClientMimeType();
                //临时绝对路径
                $realPath = $file->getRealPath();
                $filename = date('Y-m-d-H-i-s').'-'.uniqid().'.'.$ext;
                $bool = Storage::disk('uploads')->put($filename,file_get_contents($realPath));
                var_dump($bool);
            }
        }
        return view('student.upload');
    }

    public function mail(){
        //发送纯文本文件
        Mail::raw('邮件内容 测试',function($message){
            $message->from('json_vip@162.com','慕课网');
            $message->subject('邮件主题 测试');
            $message->to('76727998@qq.com');
        });

        //发送html
        Mail::send('student.mail',['name'=>'kingsleo'],function($message){
            $message->to('76727998@qq.com');
        });
    }

    public function cache1(){
        //put()
        //Cache::put('key1','val1',10);
        //add()
        //$bool = Cache::add('key2','val2',10);
        //forever()
        //Cache::forever('key3','val3');
        //has()
        if(Cache::has('key11')){
            $val = Cache::get('key1');
            var_dump($val);
        }else{
            echo "no";
        }

    }

    public function cache2(){
        //get()
        $val = Cache::get('key3');
        var_dump($val);
        //pull()    取出并删除
        $val = Cache::pull('key3');
        var_dump($val);
        //forget()  删除
        $bool = Cache::forget('key3');
    }
}