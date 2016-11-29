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
    {{--<!-- 模板中输出php变量 -->
    <p>{{ $name }}</p>
    <!-- 模板中调用php代码 -->
    <p>{{ time() }}</p>
    <p>{{ date("Y-m-d H:i:s",time()) }}</p>
    <p>{{ in_array($name,$arr) ? "true":"false" }}</p>
    <p>{{ var_dump($arr) }}</p>
    <p>{{ isset($name) ? $name:"default" }}</p>
    <p>{{ $name or "default" }}</p>
    <!-- 原样输出 -->
    <p>@{{ $name }}</p>
    --}}{{-- 模板中的注释 --}}{{--
    --}}{{-- 引入子视图 --}}{{--
    @include('tasks.common1',['name'=>$name])--}}

    @if($name == "kingsleo")
        i'm kingsleo
    @elseif($name=="zly")
        i'm zly
    @else
        who am i
    @endif
    <br>
    @if(in_array($name,$arr))
        true
    @else
        false
    @endif
    <br>
    @unless($name != "kingsleo")
        {{ $name }}
    @endunless
    <br>
    @for($i=1;$i<10;$i++)
        {{ $i }}
    @endfor
    <br>
    @foreach($tasks as $task)
        {{ $task->name }}
    @endforeach
    <br>
    @forelse($tasks as $task)
        {{ $task->name }}
    @empty
        null
    @endforelse
    <br>
    <a href="{{ url('url1') }}">url()</a>
    <br>
    <a href="{{ action('TaskController@urlTest') }}">action()</a>
    <br>
    <a href="{{ route('url2') }}">route()</a>
@stop