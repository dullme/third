@extends('layouts.app')
@section('css')
    <style type="text/css">
        .div {
            float: left;
            width: 230px;
            margin: 20px 0 0 70px;
        }

        .divSpan {
            float: left;
            width: 140px;
            height: 80px;
            background-color: #fff;
        }

        .divSpan2 {
            width: 220px;
            background-color: #fff;
        }

        .divDiv {
            padding: 5px 5px 0 5px;
        }
    </style>
@endsection
@section('content')
    <div id="index" style="left: 200px;position: absolute;top: 100px;">
        <div style="float:left;width:100%;display:inline-flex ">
            <div class="div">
                <div style="float:left;width:80px;height:80px;background-color: #fc6e53;">
                    <img src="img/indexAccount.png" style="width: 60px;padding-left: 10px; padding-top: 10px;">
                </div>
                <dvi class="divSpan" onclick="goRecharge()">
                    <div style="padding:30px 0 0 35px;">立即充值</div>
                </dvi>
            </div>
            <div class="div">
                <div style="float:left;width:80px;height:80px;background-color: #07b6ab;">
                    <img src="img/Record.png" style="width: 60px;padding-left: 10px; padding-top: 10px;">
                </div>
                <div class="divSpan" onclick="goRecharge2()">
                    <div style="padding:30px 0 0 23px;">充值/扣款记录</div>
                </div>
            </div>
            <div class="div">
                <dv style="float:left;width:80px;height:80px;background-color: #a1d369;">
                    <img src="img/see.png" style="width: 60px;padding-left: 10px; padding-top: 10px;">
                </dv>
                <div class="divSpan" onclick="goCreditor()">
                    <div style="padding:30px 0 0 35px;">债权查看</div>
                </div>
            </div>
        </div>
        <div style="width:100%;margin-top:50px;float:left;">
            <div class="div">
                <dv style="float:left;">
                    <img src="img/num.png" style="width:220px;">
                </dv>
                <div class="divSpan2">
                    <div class="divDiv">债权数</div>
                    <div class="divDiv" style="padding-bottom:5px;">{{ $count }}个</div>
                </div>
            </div>
            <div class="div">
                <dv style="float:left;">
                    <img src="img/money.png" style="width:220px;">
                </dv>
                <div class="divSpan2">
                    <div class="divDiv">债权总金额</div>
                    <div class="divDiv" style="padding-bottom:5px;">{{ $money }}万</div>
                </div>
            </div>
            <div class="div">
                <dv style="float:left;">
                    <img src="img/tomorrow.png" style="width:220px;">
                </dv>
                <div class="divSpan2">
                    <div class="divDiv">明日待还</div>
                    <div class="divDiv" style="padding-bottom:5px;">12,000万</div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            // $(".bodys")[0].style.height = window.innerHeight + 'px';
            $('#leftDiv1').addClass('trueDiv');
            $('#span1').addClass('trueSpan');
        });

        function goRecharge() {
            window.location.replace("{{ route('account') }}?" + 'haveAlert=true');
        }

        function goRecharge2() {
            window.location.replace("{{ route('account') }}");
        }

        function goCreditor() {
            window.location.replace("{{ route('debt') }}");
        }
    </script>
@endsection
