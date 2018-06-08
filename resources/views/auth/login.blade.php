<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Cache-Control" content="no-cache">
    <meta http-equiv="Expires" content="0">
    <title>登录</title>
    <style type="text/css">
        input{
            width: 200px;
        }
        .input{
            border: none;
            background-color: rgba(70, 73, 85,0);
            width: 225px;
            outline: none;
            color: #fff;
            font-size: 18px;
        }
        .div{
            border-bottom:1px solid rgba(255,255,255,0.5);
            margin: auto;
            width: 250px;
            padding: 10px 0 5px 0;
            height: 32px;
        }
        input[type = "submit"]{
            background-color: #cf6622;
            border: none;
            height: 35px;
            font-size: 12px;
            color: #fff;
            width: 250px;
            border-radius: 2px;
            margin-top: 20px;
        }
        input::-moz-placeholder{
            color: #fff;
        }
        #username
        {
            background: url(img/username.png) center left no-repeat;
            background-size: 8%;
            background-position: 1px 3px;
            height: 25px;
            padding-left: 35px;
        }
        #password
        {
            background: url(img/password.png) center left no-repeat;
            background-size: 7%;
            background-position: 1px 3px;
            height: 25px;
            padding-left: 35px;
        }
    </style>
</head>
<body style = "margin:0;height: 100%;background-image:url({{ asset('img/backgroundLogin.png') }});background-repeat:no-repeat;background-size:100%;">
<div>
    <div style = "text-align:center;background-color:#ccc;margin:auto;width:450px;height:300px;margin-top:300px;background-color: rgba(51, 51, 51,0.4); box-shadow: 1px 1px 2px #333;">
        <div style = "box-shadow: 1px 1px 1px #666;">
            <span style="color:#fff;display:block;padding:10px;font-size:14px;">小鸡惠普合作伙伴登陆</span>
        </div>
        <form class="form-horizontal" method="POST" action="{{ route('login') }}" style="margin-top: 10px">
            {{ csrf_field() }}
            @if ($errors->has('username'))
                <div style = "padding-top: 20px;font-size: 12px;">
                    <img src = "{{ asset('img/error.png') }}" style="width:10px;">
                    <span style = "color: #ff9900;">{{ $errors->first('username') }}</span>
                </div>
            @elseif($errors->has('password'))
                <div style = "padding-top: 20px;font-size: 12px;">
                    <img src = "{{ asset('img/error.png') }}" style="width:10px;">
                    <span style = "color: #ff9900;">{{ $errors->first('password') }}</span>
                </div>
            @else
                <div style = "padding-top: 40px;font-size: 12px;"></div>
            @endif
            <div class = "div">
                <input id="username" type="username" class="input" name="username" value="{{ old('username') }}" required autofocus placeholder="帐号" autocomplete="off">
            </div>
            <div class = "div">
                <input id="password" type="password" class="input" name="password" required placeholder="密码">
            </div>
            <div style = "padding:20px;">
                <input type = "submit" value = "登入" onclick="login()"/>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript" src="{{ asset('js/jquery/jquery-3.2.1.min.js') }}"></script>
<script>
    // function login(){
    //     window.location.replace("index.html");
    //     // window.location.href="index.html";
    // }
</script>
</body>
</html>