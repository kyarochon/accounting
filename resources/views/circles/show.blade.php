@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('circles/' . $circle->id) ? 'active' : '' }}"><a href="{{ route('circles.show', ['id' => $circle->id]) }}">収支</a></li>
                <li role="presentation" class="{{ Request::is('circles/*/graph') ? 'active' : '' }}"><a href="{{ route('circles.graph', ['id' => $circle->id]) }}">グラフ</a></li>
                <li role="presentation" class="{{ Request::is('circles/*/input') ? 'active' : '' }}"><a href="{{ route('circles.list', ['id' => $circle->id]) }}">一覧</a></li>
            </ul>
        </div>
        <div class="col-xs-offset-1 col-xs-10" style="margin-top:20px;">
            {!! Form::open(['route' => 'circles.index', 'method' => 'get', 'class' => 'form-inline']) !!}
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td class="col-xs-2">日付</td>
                    <td class="col-xs-8">{!! Form::date('date', null, ['class' => 'form-control']) !!}</td>
                </tr>
                <tr>
                    <td class="col-xs-2">収支種別</td>
                    <td class="col-xs-8">{!! Form::select('type', ['0' => '収入', '1' => '支出'], null, ['class' => 'form-control', 'placeholder' => '選択してください']) !!}</td>
                </tr>
                <tr>
                    <td class="col-xs-2">カテゴリ</td>
                    <td class="col-xs-8">
                        {!! Form::select(
                            'category',
                            [
                                '収入' => ['0' => '会費', '1' => '雑費'],
                                '支出' => ['2' => '消耗品費', '3' => '施設利用費', '4' => 'イベント参加費']
                            ],
                            null,
                            ['class' => 'form-control', 'placeholder' => '選択してください']
                        ) !!}
                    </td>
                </tr>
                <tr>
                    <td class="col-xs-2">内容</td>
                    <td class="col-xs-8">{!! Form::text('text', null, ['class' => 'form-control', 'placeholder' => '例：シャトル代']) !!}</td>
                </tr>
                <tr>
                    <td class="col-xs-2">金額</td>
                    <td class="col-xs-8">{!! Form::number('payments', 0, ['class' => 'form-control', 'min' => 0, 'step' => 1, 'placeholder' => '例：2500']) !!}</td>
                </tr>
            </table>
            {!! Form::submit('登録', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection