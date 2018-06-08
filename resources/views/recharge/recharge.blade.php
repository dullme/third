@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-3">
                @include('layouts.left')
            </div>
            <div class="col-xs-12 col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('recharge') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                                <label for="amount" class="col-md-4 control-label">充值金额</label>

                                <div class="col-md-6">
                                    <input id="amount" type="amount" class="form-control" name="amount" required>

                                    @if ($errors->has('amount'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('amount') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        充值
                                    </button>
                                </div>
                            </div>
                        </form>
                       网银充值

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
