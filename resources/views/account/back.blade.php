@extends('layouts.app')
@section('css')
    <style type="text/css">
        .span{
            display: inherit;
            margin-top: 20px;
        }
        .header{
            background-color: #fff;
            width: 400px;
            height: 180px;
            border-top-left-radius: 80px;
            border-bottom-left-radius: 80px;
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            float: left;
            box-shadow: 10px 10px 5px #e5e5e5;
        }
        .header2{
            float: left;
            width: 745px;
            background-color: #Fff;
            margin-left: 30px;
            height: 180px;
            box-shadow: 10px 10px 5px #e5e5e5;
            border-radius: 5px;
        }
        input[type= "button"], input[type= "submit"]{
            background-color: #ff9900;
            border: none;
            margin-top: 20px;
            width: 106px;
            height: 43px;
            color: #fff;
            border-radius: 5px;
            font-size: 18px;
        }
        img{
            width: 50px;
        }
        .clickSpan{
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #fff;
            float: left;
            border-bottom: none;
        }
        .clickTrue{
            background-color: #ff9900;
            color: #fff;
        }
        tr{
            border: 1px solid #ccc;
        }
        tr>th{
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            height: 40px;
            font-weight: 100;
            font-size: 17px;
        }
        tr>td{
            border-bottom: 1px solid #ccc;
            border-right: 1px solid #ccc;
            height: 40px;
        }
        .trHeader{
            font-size: 17px;
            font-weight: 100;
            background-color: #a8c1d4;
            color: #fff;
        }
        .alertDiv{
            position: absolute;
            background-color: #fff;
            margin: auto;
            left: 0;
            right: 0;
            top: -100px;
            bottom: 0;
            text-align: center;
            margin: auto;
            width: 600px;
            height: 400px;
            border-radius: 10px;
        }
        .alertButton{
            background-color: #ff9900;
            border: none;
            margin-top: 20px;
            font-size: 18px;
            width: 200px !important;
            height: 40px !important;
            border-radius: 5px !important;
            color: #fff !important;
            text-decoration: none;
            padding: 8px 20px;
        }
    </style>
@endsection
@section('content')
    <div style =  "margin-top: 20%;text-align:center;left: 180px;position: fixed;top: 75px;background-color: rgba(242, 242, 242, 1);height:100%;width:90%;">
        @if($result['status'])
        <div>
            <img style = "width:60px;" src = "img/success.png">
        </div>
        <div style = "margin:20px;">
            <span style = "font-weight: bold;font-size: 18px;">操作成功</span>
        </div>
        @else
            <div>
                <img style = "width:60px;" src = "img/err.png">
            </div>
            <div style = "margin:20px;">
                <span style = "font-weight: bold;font-size: 18px;">操作失败</span>
            </div>
            <div style = "margin-bottom:20px;">
                <span>失败原因:{{ $result['message'] }}</span>
            </div>
        @endif
        <a href="{{ route('account') }}" class = "alertButton">返回资金管理</a>
    </div>

@endsection