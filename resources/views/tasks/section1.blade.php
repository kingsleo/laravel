@extends("layouts")

@section("header")
    @parent
    header
@stop

@section("sidebar")
    @parent
    sidebar
@stop

@section("content")
    content
    <!-- 模板中输出php变量 -->
    <p>{{ $name }}</p>
    <!-- 模板中调用php代码 -->
    <p>{{ time() }}</p>
    <p>{{ date("Y-m-d H:i:s",time()) }}</p>
    <p>{{ in_array($name,$arr) ? "true":"false" }}</p>
    <p>{{ var_dump($arr) }}</p>
    <p>{{ isset($name) ? $name:"default" }}</p>
    <p>{{ $name or "default" }}</p>

    {{-- 模板中的注释 --}}

    {{-- 引入子视图 --}}
    @include('tasks.common1',['name'=>$name])
@stop