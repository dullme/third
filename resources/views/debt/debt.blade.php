@extends('layouts.app')
@section('css')
    <style type="text/css">
        tr {
            border: 1px solid #ccc;
            height: 45px;
        }

        .trHeader {
            font-size: 17px;
            font-weight: 100;
            background-color: #a8c1d4;
            color: #fff;
        }

        tr > th {
            border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
            height: 40px;
            font-weight: 100;
        }

        tr > td {
            border-bottom: 1px solid #ccc;
            border-right: 1px solid #ccc;
            font-size: 14px;
        }

        .divAlert {
            float: left;
            padding: 10px;
            width: 350px;
        }

        .inputAlert {
            border: none;
            background-color: #fff;
        }

        .divSpanAlert {
            width: 100px;
            display: block;
            float: left;
            padding-left: 50px;
        }

        .showAll > div > div > input {
            width: 400px;
        }

        .showAll > div > div {
            float: left;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .showAll > div > div > span {
            width: 100px;
            display: block;
            float: left;
        }

        .showAll > div {
            width: 100%;
            float: left;
        }

        .showAll {
            margin-top: 10px;
        }

        .show2Span {
            border-bottom: 1px solid #ccc;
        }

        .show2Span > span {
            padding: 10px;
            background-color: blue;
            opacity: 0.8;
            color: #Fff;
            width: 130px;
            display: inline-block;
            text-align: center;
        }

        .clickSpan {
            padding: 15px;
            border: 1px solid #ccc;
            background-color: #fff;
            float: left;
            border-bottom: none;
        }

        .clickTrue {
            background-color: #ff9900;
            color: #fff;
        }

        input[type= "submit"] {
            background-color: #ff9900;
            border: none;
            margin-top: 15px;
            width: 79px;
            height: 35px;
            color: #fff;
            border-radius: 5px;
            font-size: 16px;
            margin-left: 20px;
        }

        .input {
            border-radius: 5px;
            border: 1px solid #ccc;
            height: 35px;
            padding-left: 2px;
        }
    </style>
@endsection
@section('content')
    <div id="original" style="left: 200px;position: absolute;top: 100px;">
        <div style="width: 100%;height: 52px;border-bottom: 1px solid #ccc;">
            @if($request->type !=2)
                <div class="clickSpan clickTrue" id="clickSpan1" onclick="shenqing()" style="float:left;">申请列表</div>
                <div class="clickSpan" id="clickSpan2" onclick="fangkuan()">已被放款债权</div>
            @else
                <div class="clickSpan" id="clickSpan1" onclick="shenqing()" style="float:left;">申请列表</div>
                <div class="clickSpan clickTrue" id="clickSpan2" onclick="fangkuan()">已被放款债权</div>
            @endif
        </div>
        <div style="padding-left:40px;padding-top:20px;padding-bottom:20px;background-color:#fff;box-shadow: 2px 2px 5px #e5e5e5;padding-right: 30px;">
            <div style="padding-bottom:30px;">
                <!-- Torm -->
                <form class="form-inline" method="get" action="{{ route('debt') }}">
                    <input class="input" type="text" name="name" value="{{ $request->get('name') }}"
                           placeholder="客户姓名"/>
                    <input class="input" style="margin-left:20px;" type="text" name="mobile"
                           value="{{ $request->get('mobile') }}" placeholder="手机号"/>
                    <input class="input" style="margin-left:20px;" type="text" name="id_card"
                           value="{{ $request->get('id_card') }}" placeholder="身份证号码"/>
                    <input class="input layui-input" style="margin-left:50px;width: 150px;" id="date1" name="start"
                           value="{{ $request->get('start') }}" placeholder="放款时间" autocomplete="off"/>
                    <span>至</span>
                    <input class="input layui-input" style="width: 150px;" id="date2" name="end"
                           value="{{ $request->get('end') }}" placeholder="放款时间" autocomplete="off"/>
                    <input type="submit" value="搜索"/>
                </form>
                <!-- End form -->
            </div>
            <div>
                @if($request->type ==2)
                    <table id="table1" cellspacing="0"
                           style="border:1px solid #ccc;width:100%;text-align:center;margin-top:20px;background-color:#fff;">
                        <tr class="trHeader">
                            <th style="width:100px;">债权ID</th>
                            <th style="width:250px;">合同编号</th>
                            <th style="width:200px;">放款日期</th>
                            <th style="width:150px;">金额</th>
                            <th style="width:150px;">客户姓名</th>
                            <th style="width:150px;">年利率</th>
                            <th style="width:100px;">期限</th>
                            <th style="width:200px;">状态</th>
                        </tr>
                        @foreach($debts as $debt)
                            <tr>
                                <td>{{ $debt->asset_id }}</td>
                                <td>{{ $debt->agreement_number }}</td>
                                <td>{{ $debt->update_time }}</td>
                                <td>{{ $debt->borrow_money }}</td>
                                <td>{{ $debt->name }}</td>
                                <td>{{ $debt->month_rate }}</td>
                                <td>{{ $debt->borrow_term }}</td>
                                <td><a href="javaScript:void(0)" style="text-decoration:none;"
                                       onclick="showDetailForPlan({{ $debt->id }})">查看还款计划</a></td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{ $debts->appends($request->all())->links() }}
                    </div>
                @else
                    <table id="table2" cellspacing="0"
                           style="border:1px solid #ccc;width:100%;text-align:center;margin-top:20px;background-color:#fff;">
                        <tr class="trHeader">
                            <th style="width:100px;">合同ID</th>
                            <th style="width:250px;">客户姓名</th>
                            <th style="width:200px;">手机号</th>
                            <th style="width:150px;">申请金额</th>
                            <th style="width:150px;">申请时间</th>
                            <th style="width:150px;">贷款期限</th>
                            <th style="width:100px;">状态</th>
                            <th style="width:200px;">申请详情</th>
                        </tr>
                        @foreach($debts as $debt)
                            <tr>
                                <td>{{ $debt->id }}</td>
                                <td>{{ $debt->name }}</td>
                                <td>{{ $debt->mobile }}</td>
                                <td>{{ $debt->borrow_money }}</td>
                                <td>{{ $debt->borrow_date }}</td>
                                <td>{{ $debt->borrow_term }}</td>
                                <td>{{ getDebtStatus()[$debt->status] }}</td>
                                <td onclick="showDetail({{ $debt->id }})">查看详情</td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="text-center">
                        {{ $debts->appends($request->all())->links() }}
                    </div>
                @endif
            </div>
            @if($request->type ==2)
                @foreach($collection as $debt)
                    <div id="plan{{$debt->id}}"
                         style="display:none;position: fixed;height:100%;width:100%;top:0;left:0;background-color: rgb(255, 255, 255,0.5);">
                        <div id="showOrHidePlan{{$debt->id}}"
                             style="position: fixed;top:100px;left:200px;background-color:#fff; min-height: 100%">
                            <div style="padding:10px;border-bottom: 1px solid #ccc;">
                                <span>还款计划表</span>
                                <span onclick="closePlan({{$debt->id}})"
                                      style="float:right;padding-right:20px;">关闭</span>
                            </div>
                            <div>
                                <div style="display: inline-block;">
                                    <div class="divAlert">
                                        <span class="divSpanAlert">借款人:</span>
                                        <input class="inputAlert" value="{{ $debt->name }}" disabled="disabled"/>
                                    </div>
                                    <div class="divAlert">
                                        <span class="divSpanAlert">身份证号:</span>
                                        <input class="inputAlert" value="{{ $debt->id_card }}" disabled="disabled"/>
                                    </div>
                                    <div class="divAlert">
                                        <span class="divSpanAlert">借款类型</span>
                                        <input class="inputAlert" value="{{ getBorrowTypeName()[$debt->borrow_type] }}"
                                               disabled="disabled"/>
                                    </div>
                                </div>
                                <div style="display: inline-block;">
                                    <div class="divAlert">
                                        <span class="divSpanAlert">合同编号:</span>
                                        <input class="inputAlert" value="{{ $debt->agreement_number }}"
                                               disabled="disabled"/>
                                    </div>
                                    <div class="divAlert">
                                        <span class="divSpanAlert">借款时间:</span>
                                        <input class="inputAlert" value="{{ $debt->create_time }}" disabled="disabled"/>
                                    </div>
                                    <div class="divAlert">
                                        <span class="divSpanAlert">计息方式:</span>
                                        <input class="inputAlert" value="{{ getPayTypeName()[$debt->pay_type] }}"
                                               disabled="disabled"/>
                                    </div>
                                </div>
                                <div style="display: inline-block;">
                                    <div class="divAlert">
                                        <span class="divSpanAlert">借款金额:</span>
                                        <input class="inputAlert" value="{{ $debt->borrow_money }}"
                                               disabled="disabled"/>
                                    </div>
                                    <div class="divAlert">
                                        <span class="divSpanAlert">年化利率:</span>
                                        <input class="inputAlert" value="9.5%" disabled="disabled"/>
                                    </div>
                                    <div class="divAlert">
                                        <span class="divSpanAlert">期数</span>
                                        <input class="inputAlert" value="{{ $debt->borrow_term }}" disabled="disabled"/>
                                    </div>
                                </div>
                                <table cellspacing="0"
                                       style="border:1px solid #ccc;text-align:center;margin-left:50px;margin-top:20px;background-color:#fff; width: 90%">
                                    <tr class="trHeader">
                                        <th style="width:15%">期数</th>
                                        <th style="width:15%;">应还时间</th>
                                        <th style="width:30%">应还总额</th>
                                        <th style="width:30%">还款状态</th>
                                    </tr>
                                    @php
                                        $repayment_list = json_decode($debt->repayment_list,true);
                                    @endphp
                                    @foreach($repayment_list as $repayment)
                                        <tr>
                                            <td>{{ $repayment['term'] }}</td>
                                            <td>{{ $repayment['plan_date'] }}</td>
                                            <td>{{ $repayment['actual_amount'] }}</td>
                                            <td>{{ $repayment['online_status'] == 3?'已还款':'未还款' }}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                @foreach($debts as $debt)
                    <div id="detail{{$debt->id}}"
                         style="display:none;position: fixed;height:100%;width:100%;top:0;left:0;background-color: rgb(255, 255, 255,0.5);">
                        <div id="showOrHideDetail{{$debt->id}}"
                             style="position: fixed;top:100px;left:200px;background-color:#fff;height: 100%;overflow: scroll">
                            <div style="border-bottom:1px solid #ccc;padding:10px;font-size:20px;">
                                <span>申请详情</span>
                                <span style="float:right;" onclick="closesDetail({{$debt->id}})">关闭</span>
                            </div>
                            <div style="padding:30px; padding-bottom: 100px">
                                <div>
                                    <div class="show2Span">
                                        <span>客户基本信息</span>
                                    </div>
                                    <div class="showAll">
                                        <div>
                                            <div class="">
                                                <span>客户姓名:</span>
                                                <input value="{{ $debt->name }}" disabled="disabled"/>
                                            </div>
                                            <div>
                                                <span>手机号码:</span>
                                                <input value="{{ $debt->mobile }}" disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                                <span>证件类型:</span>
                                                <input value="身份证" disabled="disabled"/>
                                            </div>
                                            <div>
                                                <span>证件号码:</span>
                                                <input value="{{ $debt->id_card }}" disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                                <span>婚姻状况:</span>
                                                <input value="{{ getWedlock()[$debt->wedlock] }}" disabled="disabled"/>
                                            </div>
                                            <div>
                                                <span>籍贯:</span>
                                                <input value="{{ $debt->originaddr }}" disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                                <span>个人月收入:</span>
                                                <input value="{{ $debt->month_income }}" disabled="disabled"/>
                                            </div>
                                            <div>
                                                <span>工作性质:</span>
                                                <input value="{{ getNatureWork()[$debt->nature_work] }}"
                                                       disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                                <span>现住址:</span>
                                                <input value="{{ $debt->livingaddr }}" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="show2Span">
                                        <span>客户贷款意向</span>
                                    </div>
                                    <div class="showAll">
                                        <div>
                                            <div class="">
                                                <span>借款金额:</span>
                                                <input value="{{ $debt->borrow_money }}" disabled="disabled"/>
                                            </div>
                                            <div>
                                                <span>还款方式:</span>
                                                <input value="{{ getPayTypeName()[$debt->pay_type] }}"
                                                       disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                                <span>借款期限:</span>
                                                <input value="{{ $debt->borrow_term }}" disabled="disabled"/>
                                            </div>
                                            <div>
                                                <span>资金需求时间:</span>
                                                <input value="{{ $debt->borrow_date }}" disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                                <span>借款目的:</span>
                                                <input value="{{ $debt->borrow_goal }}" disabled="disabled"/>
                                            </div>
                                            <div>
                                                <span>贷款类型:</span>
                                                <input value="{{ getBorrowTypeName()[$debt->borrow_type] }}"
                                                       disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                                <span>项目名称:</span>
                                                <input value="{{ $debt->project_name }}" disabled="disabled"/>
                                            </div>
                                            <div>
                                                <span>债权归属:</span>
                                                <input value="{{ $debt->ownership_id }}" disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                                <span>进件单标识:</span>
                                                <input value="@if($debt->is_online == 1) 线上@else 线下 @endif"
                                                       disabled="disabled"/>
                                            </div>
                                            <div>
                                                <span>还款能力:</span>
                                                <input value="{{ $debt->pay_ability }}" disabled="disabled"/>
                                            </div>
                                        </div>
                                        <div>
                                            <div class="">
                                                <span>备注:</span>
                                                <input value="{{ $debt->memo }}" disabled="disabled"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="show2Span">
                                        <span>图片信息</span>
                                    </div>
                                    <div>
                                        <span>身份证</span>
                                        <div>
                                            <img src="{{ getOssUri($debt->id_card_url_a) }}">
                                            <img src="{{ getOssUri($debt->id_card_url_b) }}">
                                        </div>
                                    </div>
                                    <div>
                                        <span>营业执照</span>
                                        <div>
                                            <img src="{{ getOssUri($debt->business_license_url) }}">
                                        </div>
                                    </div>
                                    <div>
                                        <span>证件报告</span>
                                        <div>
                                            <img src="{{ getOssUri($debt->report_url) }}">
                                        </div>
                                    </div>
                                    <div>
                                        <span>第三方合同</span>
                                        <div>
                                            @if($debt->agreement_url)
                                                <a href="{{ getOssUri($debt->agreement_url) }}">查看第三方合同</a>
                                            @else
                                                暂无
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{{ asset('js/layDate-v5.0.9/laydate/laydate.js') }}"></script>
    <script>
        $(function () {
            // $(".bodys")[0].style.height = window.innerHeight + 'px';
            $('#leftDiv3').addClass('trueDiv');
            $('#span3').addClass('trueSpan');
        });

        function showDetail(id) {
            //获取当前子页面的宽度
            var width = $('#original')[0].offsetWidth;
            $('#showOrHideDetail' + id)[0].style.width = width + 20 + 'px';
            $('#detail' + id).show();
        }

        function closesDetail(id) {
            $('#detail' + id).hide();
        }

        function shenqing() {
            window.parent.frames.location.href = "{{ url('debt?type=1') }}";
        }

        function fangkuan() {
            window.parent.frames.location.href = "{{ url('debt') }}?type=2&status=7";
        }

        function showDetailForPlan(id) {
            //获取当前子页面的宽度
            var width = $('#original')[0].offsetWidth;
            $('#showOrHidePlan' + id)[0].style.width = width + 'px';
            $('#plan' + id).show();
        }

        function closePlan(id) {
            $('#plan' + id).hide();
        }

        //常规用法
        laydate.render({
            type: 'datetime',
            elem: '#date1', done: function (value, date, endDate) {
                if (document.getElementById('date2').value < value) {
                    document.getElementById('date1').value = "";
                }
            }
        });
        laydate.render({
            type: 'datetime',
            elem: '#date2', done: function (value, date, endDate) {
                if (document.getElementById('date1').value > value) {
                    document.getElementById('date2').value = "";
                }
            }
        });
    </script>
@endsection