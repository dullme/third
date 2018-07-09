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
        width: 200px !important;
        height: 40px !important;
        border-radius: 5px !important;
        color: #fff !important;
    }
</style>
@endsection
@section('content')
<div style = "left: 180px;position: absolute;top: 80px;">
    <div style = "height:220px;width:100%;">
        <div class = "header">
            <div style = "float:left;">
                <img src = "img/balance.png" style = "width:90px;margin:45px 0 0 30px;">
            </div>
            <div style="float:left;margin-left:80px;text-align:center;font-size:20px;">
                <span class =  "span">账户余额</span>
                <span class =  "span" style = "font-size: 25px;">{{ $balance }} 元</span>
                <input type = "button" onclick="show()" value = "充值"/>
            </div>
        </div>
        <div class = "header2">
            <div style = "text-align:center;">
                <img src = "img/time.png" style = "width: 30px;position: relative;top: 10px;right: 4px;">
                <input class = "layui-input" style = "width:100px;" id = "date1" placeholder="{{ \Carbon\Carbon::tomorrow()->toDateString() }}"/>
            </div>
            <div>
                <div style = "float:left;text-align:center;width:370px;border-right:1px solid #ccc;">
                    <div>
                        <img src = "img/number.png">
                    </div>
                    <div id="total-count" style = "font-size: 30px;">{{ $totalCount }}</div>
                    <div style = "margin-top:10px;color:#666;">待还债权数量(个)</div>
                </div>
                <div style = "float:left;text-align:center;width:370px;">
                    <div>
                        <img src = "img/RMB.png">
                    </div>
                    <div id="total-borrowMoney" style = "font-size: 30px;">{{ $totalBorrowMoney }}</div>
                    <div style = "margin-top:10px;color:#666;">待还金额(元)</div>
                </div>
            </div>
        </div>
    </div>
    <div style = "background-color:#fff;width:1150px;padding:25px 0 0 25px;height:100%;">
        <div style = "width:100%;height:52px;margin-bottom:10px;border-bottom:1px solid #ccc;">
            <span onclick = "chongzhi()" id = "clickSpan1" class = "clickSpan clickTrue">充值扣款记录</span>
        </div>
        <div>
            @if(isset($rechargeHistory['data']))
            <table id = "table1" cellspacing="0" style = "border:1px solid #ccc;width:1150px;text-align:center;margin-top:20px;background-color:#fff;">
                <tr class = "trHeader">
                    <th style = "width:50px;">ID</th>
                    <th style = "width:150px;">流水号</th>
                    <th style = "width:150px;">日期</th>
                    <th style = "width:100px;">类型</th>
                    <th style = "width:120px;">充值金额(元)</th>
                    <th style = "width:50px;">状态</th>
                    <th style = "width:150px;">备注</th>
                </tr>
                @foreach($rechargeHistory['data'] as $key=>$item)
                    <tr>
                        <th scope="row">{{ $rechargeHistory['page']['firstRow']++ }}</th>
                        <td>{{ $item['billno'] }}</td>
                        <td>{{ date('Y-m-d H:i',$item['add_time']) }}</td>
                        <td>
                            @if($item['type'] == 'borrow_repayment')
                                扣款
                            @else
                                充值
                            @endif
                        </td>
                        <td>{{ $item['money'] }}</td>
                        <td>$item['status']</td>
                        <td>{{ $item['response_message'] }}</td>
                    </tr>
                @endforeach

            </table>


            <div class="text-center">
                <ul class="pagination">
                    @if($rechargeHistory['page']['currentPage'] == 1)
                        <li class="disabled"><span>«</span></li>
                    @else
                        <li><a href="/account?page={{$rechargeHistory['page']['currentPage'] - 1}}" rel="next">«</a></li>
                    @endif

                    @for($i=1; $i<=$rechargeHistory['page']['rollPage'];$i++)
                        @if($i == $rechargeHistory['page']['currentPage'])
                            <li class="active"><span>{{ $i }}</span></li>
                        @else
                            <li><a href="/account?page={{ $i }}">{{ $i }}</a></li>
                        @endif
                    @endfor

                    @if($rechargeHistory['page']['currentPage'] == $rechargeHistory['page']['rollPage'])
                        <li class="disabled"><span>»</span></li>
                    @else
                        <li><a href="/account?page={{$rechargeHistory['page']['currentPage'] + 1}}" rel="next">»</a></li>
                    @endif

                </ul>
            </div>

            @endif

        </div>
    </div>
    <div id = "show" style =  "display:none;position: fixed;height:100%;width:100%;top:0;left:0;background-color: rgba(102, 102, 102, 0.768627450980392);">
        <div id = "showOrHide" class = "alertDiv">
            <div style = "width:600px;height:60px;border-bottom:1px solid #ccc;font-size:25px;color:#666;">
                <span style = "float:left;padding-left: 20px;padding-top: 20px;">网银充值</span>
                <span style = "float:right;padding-right: 20px;padding-top: 20px;" onclick="closeAlert()">关闭</span>
            </div>
            <div>
                <div>
                    <img src = "img/xinwang.png" style = "width:350px;">
                </div>

                <form class="form-horizontal" method="POST" action="{{ route('recharge') }}">
                    {{ csrf_field() }}
                    <div>
                        <input id="amount" type="amount" style = "width: 300px;height: 50px;border-radius: 5px;border: 1px solid #ccc;padding-left: 5px;" class="form-control" name="amount" required placeholder="请输入充值金额,需大于5元">
                    </div>
                    <div>
                        <input  type="submit" value = "充值" onclick="recharge()"/>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div id = "showSuccess" style =  "text-align:center;display:none;left: 180px;position: fixed;top: 75px;background-color: rgba(242, 242, 242, 1);height:100%;width:90%;">
        <div>
            <img style = "width:60px;" src = "img/success.png">
        </div>
        <div style = "margin:20px;">
            <span class = "alertButton" style = "font-weight: bold;font-size: 18px;">充值成功</span>
        </div>
        <input type = "button" onclick="closeSuccess()" value = "返回资金管理"/>
    </div>
    <div id = "showErr" style =  "text-align:center;display:none;left: 180px;position: fixed;top: 75px;background-color: rgba(242, 242, 242, 1);height:100%;width:90%;">
        <div>
            <img style = "width:60px;" src = "img/err.png">
        </div>
        <div style = "margin:20px;">
            <span style = "font-weight: bold;font-size: 18px;">充值失败</span>
        </div>
        <div style = "margin-bottom:20px;">
            <span>失败原因:xxxxxxxxxxxxxxxxx</span>
        </div>
        <input class = "alertButton" type = "button" onclick="closeErr()" value = "返回资金管理"/>
    </div>
</div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('js/layDate-v5.0.9/laydate/laydate.js') }}"></script>
    <script>
    $(function() {
        // $(".bodys")[0].style.height = window.innerHeight + 'px';
        var search = window.location.search;
        if(search.indexOf('haveAlert=true')>-1){
            $("#show").show();
        }
        $('#leftDiv2').addClass('trueDiv');
        $('#span2').addClass('trueSpan');
    });
    function closeSuccess(){
        $('#showSuccess').hide();
    }
    function closeErr(){
        $('#showErr').hide();
    }
    function closeAlert(){
        $("#show").hide();
    }
    function show(){
        $("#show").show();
    }
    function chongzhi(){
        $('#clickSpan1').addClass('clickTrue');
        $('#clickSpan2').removeClass('clickTrue');
        $('#table1').show();
        $('#table2').hide();
    }
    function koukuan(){
        $('#clickSpan2').addClass('clickTrue');
        $('#clickSpan1').removeClass('clickTrue');
        $('#table2').show();
        $('#table1').hide();
    }
    laydate.render({
        elem: '#date1',done: function (value, date, endDate) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type : "POST",
                url : "{{ url('account/count-money') }}",
                // dataType : "json",
                data:{'date':value },
                success : function(data) {
                    $('#total-borrowMoney').html(data.totalBorrowMoney);
                    $('#total-count').html(data.totalCount);
                    console.log(totalBorrowMoney);
                }
            });
        }
    });
</script>
@endsection
