<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/public.css') }}" rel="stylesheet">

    <style type="text/css">
        .img{
            width: 30px;
            position: relative;
            top: 14px;
            left: 15px;
        }
        .left-div-span{
            height: 60px;
            width: 10px;
            color: rgba(70, 73, 85);
            display: block;
            float: left;
        }
        .trueSpan{
            background-color: #ff9900;
            color: #ff9900;
        }
        .trueDiv{
            background-color: #666666;
        }
        .pagination{
            list-style: none;
            min-height: 20px;
            margin-top: 10px;
            text-align: center;
        }
        .pagination>li{
            margin-left: 10px;
            display: inline;
            padding-left: 6px;
            padding-right: 5px;
            background-color: #fff;
        }
    </style>
    @yield('css')
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/public.js') }}"></script>
</head>
<body style = "background-color: rgba(242, 242, 242, 1);margin:0;height:100%;width:100%;">
<div style = "position: fixed;z-index:999;width:100%;height:100%">
    <div style = "background-color: rgba(70, 73, 85, 1);height:50px;width:100%;position: fixed;z-index:999;">
        <span style = "color:#fff;padding:5px;position: fixed;">小鸡惠普</span>
        <div style = "float:right;color:#fff;padding-right:50px;">
            <span>欢迎{{ Auth::user()->name }}用户</span>
            <img class = "img"  onclick="logout()" style = "top:9px;left:0px;" src = "{{ asset('img/cancellation.png') }}">
            <span onclick="logout()">注销</span>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    @include('layouts.left')
    @yield('content')
</div>
<script>
    function logout(){
        // event.preventDefault();
        document.getElementById('logout-form').submit();
    }
    function goIndex(){
        window.parent.frames.location.href="{{ url('/') }}";
    }
    function goAccount(){
        window.parent.frames.location.href="{{ route('account') }}";
    }
    function goZhaiQuan(){
        window.parent.frames.location.href="{{ route('debt') }}";
    }
</script>
@yield('script')
</body>
</html>