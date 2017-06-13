@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-info pull-right" onclick="location.href='{{ route('circles.member', ['id' => $circle->id]) }}'">メンバー管理</button>
        </div>
        <div class="col-xs-12" style="margin-top:20px;">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('circles/' . $circle->id) ? 'active' : '' }}"><a href="{{ route('circles.show', ['id' => $circle->id]) }}">収支</a></li>
                <li role="presentation" class="{{ Request::is('circles/*/graph') ? 'active' : '' }}"><a href="{{ route('circles.graph', ['id' => $circle->id]) }}">グラフ</a></li>
                <li role="presentation" class="{{ Request::is('circles/*/list') ? 'active' : '' }}"><a href="{{ route('circles.list', ['id' => $circle->id]) }}">一覧</a></li>
            </ul>
        </div>
        <div class="col-xs-offset-1 col-xs-10" style="margin-top:20px;">    
            <table class="table table-bordered table-hover table-striped">
                <tr>
			        <th>日時</th>
			        <th>タイプ</th>
			        <th>カテゴリ</th>
			        <th>内容</th>
			        <th>金額</th>
		        </tr>
                @foreach ($circle_payments as $circle_payment)
                <tr>
                    <td>{{$circle_payment->date}}</td>
                    <td>{{$circle_payment->getTypeText()}}</td>
                    <td>{{$circle_payment->getCategoryText()}}</td>
                    <td>{{$circle_payment->text}}</td>
                    @if ($circle_payment->type == \Config::get('const.TYPE_INCOME'))
                        <th style="color:#00f; text-align:right">{{$circle_payment->payments}}</th>
                    @else
                        <th style="color:#f00; text-align:right">{{$circle_payment->payments}}</th>
                    @endif
                </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align:right">合計</td>
                    @if ($total_fee >= 0)
                        <th style="color:#00f; text-align:right">{{$total_fee}}</th>
                    @else
                        <th style="color:#f00; text-align:right">{{$total_fee}}</th>
                    @endif
                </tr>

            </table>
        </div>
    </div>
@endsection