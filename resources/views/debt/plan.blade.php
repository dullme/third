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
                        还款计划表
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-4 col-md-4">
                                <p>借款人：某某某</p>
                                <p>合同编号：123123</p>
                                <p>借款金额：16000</p>
                            </div>
                            <div class="col-xs-4 col-md-4">
                                <p>身份证号：223748876763476511</p>
                                <p>借款时间：2018-06-10</p>
                                <p>年化利率：95%</p>
                            </div>
                            <div class="col-xs-4 col-md-4">
                                <p>借款类型：云联贷</p>
                                <p>计息方式：按月付息，到期还本</p>
                                <p>期数：3</p>
                            </div>
                        </div>

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>期数</th>
                                    <th>应还时间</th>
                                    <th>应还总额</th>
                                    <th>应还本金</th>
                                    <th>应还利息</th>
                                    <th>生命周期服务费</th>
                                    <th>信息费</th>
                                    <th>还款状态</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>123456790</td>
                                    <td>2018-06-11</td>
                                    <td>扣款</td>
                                    <td>100</td>
                                    <td>0</td>
                                    <td>扣款成功</td>
                                    <td>未还款</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection