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
            test
        </div>
    </div>
@endsection



