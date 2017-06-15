
<?php
    // カテゴリ選択肢を自動で作成
    
    // 収入
    $incomeSelectList = array();
    $incomeCategories = \Config::get('const.INCOME_CATEGORIES');
    foreach ($incomeCategories as $incomeCategory) {
        $incomeSelectList[$incomeCategory] = \Config::get('const.CATEGORY_NAME')[$incomeCategory];
    }
    
    // 支出
    $spendingSelectList = array();
    $spendingCategories = \Config::get('const.SPENDING_CATEGORIES');
    foreach ($spendingCategories as $spendingCategory) {
        $spendingSelectList[$spendingCategory] = \Config::get('const.CATEGORY_NAME')[$spendingCategory];
    }
?>
                        
                        
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
                <li role="presentation" class="{{ Request::is('circles/*/input') ? 'active' : '' }}"><a href="{{ route('circles.list', ['id' => $circle->id]) }}">一覧</a></li>
            </ul>
        </div>
        <div class="col-xs-offset-1 col-xs-10" style="margin-top:20px;">
            {!! Form::open(['route' => 'circle_payments.store', 'method' => 'post', 'class' => 'form-inline']) !!}
            {!! Form::hidden('circle_id', $circle->id); !!}
            <table class="table table-bordered table-hover table-striped">
                <tr>
                    <td class="col-xs-2">日付</td>
                    <td class="col-xs-8">{!! Form::date('date', null, array('required' => 'required'), ['class' => 'form-control']) !!}</td>
                </tr>
                <tr>
                    <td class="col-xs-2">収支種別</td>
                    <td class="col-xs-8">{!! Form::select('type', ['0' => '収入', '1' => '支出'], null, array('required' => 'required'), ['class' => 'form-control', 'placeholder' => '選択してください']) !!}</td>
                </tr>
                <tr>
                    <td class="col-xs-2">カテゴリ</td>
                    <td class="col-xs-8">
                        {!! Form::select(
                            'category',
                            [
                                '収入' => $incomeSelectList,
                                '支出' => $spendingSelectList
                            ],
                            null,
                            array('required' => 'required'),
                            ['class' => 'form-control', 'placeholder' => '選択してください']
                        ) !!}
                    </td>
                </tr>
                <tr>
                    <td class="col-xs-2">内容</td>
                    <td class="col-xs-8">{!! Form::text('text', null, array('required' => 'required'), ['class' => 'form-control', 'placeholder' => '例：シャトル代']) !!}</td>
                </tr>
                <tr>
                    <td class="col-xs-2">金額</td>
                    <td class="col-xs-8">{!! Form::number('payments', 0, array('required' => 'required'), ['class' => 'form-control', 'min' => '0', 'step' => '1', 'placeholder' => '例：2500']) !!}</td>
                </tr>
            </table>
            {!! Form::submit('登録', ['class' => 'btn btn-success']) !!}
            {!! Form::close() !!}
        </div>
    </div>
@endsection