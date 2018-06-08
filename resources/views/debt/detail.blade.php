@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('layouts.left')
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        债权详情
                    </div>
                    <div class="panel-body">
                        <h4><span class="label label-primary">基本信息</span></h4>
                        <div class="row">
                            <div class="col-xs-4 col-md-6">
                                <p>客户姓名：{{ $debt->name }}</p>
                                <p>证件类型：身份证</p>
                                <p>婚姻状况：{{ $debt->wedlock }}</p>
                                <p>个人月收入：{{ $debt->month_income }}元</p>
                                <p>现住地址：{{ $debt->livingaddr }}</p>
                            </div>
                            <div class="col-xs-4 col-md-6">
                                <p>手机号：{{ $debt->mobile }}</p>
                                <p>证件号码：{{ $debt->id_card }}</p>
                                <p>籍贯：{{ $debt->originaddr }}</p>
                                <p>工作性质：{{ $debt->nature_work }}</p>
                            </div>
                        </div>

                        <h4><span class="label label-primary">客户贷款意向</span></h4>
                        <div class="row">
                            <div class="col-xs-4 col-md-6">
                                <p>借款金额：{{ $debt->borrow_money }}</p>
                                <p>借款期限：{{ $debt->borrow_term }}</p>
                                <p>借款目的：{{ $debt->borrow_goal }}</p>
                                <p>项目名称：{{ $debt->project_name }}</p>
                                <p>进件单标识：{{ $debt->is_online }}</p>
                                <p>备注：{{ $debt->memo }}</p>
                            </div>
                            <div class="col-xs-4 col-md-6">
                                <p>还款方式：{{ $debt->pay_type }}</p>
                                <p>资金需求时间：{{ $debt->borrow_date }}</p>
                                <p>贷款类型：{{ $debt->borrow_type }}</p>
                                <p>债权归属：{{ $debt->ownership_id }}</p>
                                <p>还款能力：{{ $debt->pay_ability }}</p>
                            </div>
                        </div>

                        <h4><span class="label label-primary">图片信息</span></h4>
                        <p>身份证件：
                            <a href="{{ getOssUri($debt->id_card_url_a) }}">
                                <img width="40%" src="{{ getOssUri($debt->id_card_url_a) }}">
                            </a>
                            <a href="{{ getOssUri($debt->id_card_url_b) }}">
                                <img width="40%" src="{{ getOssUri($debt->id_card_url_b) }}">
                            </a>
                        </p>

                        <p>营业执照：
                            <a href="{{ getOssUri($debt->business_license_url) }}">
                                <img width="80%" src="{{ getOssUri($debt->business_license_url) }}">
                            </a>
                        </p>

                        <p>征信报告：
                            <a href="{{ getOssUri($debt->report_url) }}">
                                <img width="80%" src="{{ getOssUri($debt->report_url) }}">
                            </a>
                        </p>

                        <p>三方合同：
                            @if($debt->agreement_url)
                                <a href="{{ getOssUri($debt->agreement_url) }}" target="_blank">查看第三方合同</a>
                            @else
                                暂无
                            @endif

                        </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection