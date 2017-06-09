@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('circles/' . $circle->id) ? 'active' : '' }}"><a href="{{ route('circles.show', ['id' => $circle->id]) }}">収支</a></li>
                <li role="presentation" class="{{ Request::is('circles/*/graph') ? 'active' : '' }}"><a href="{{ route('circles.graph', ['id' => $circle->id]) }}">グラフ</a></li>
                <li role="presentation" class="{{ Request::is('circles/*/list') ? 'active' : '' }}"><a href="{{ route('circles.list', ['id' => $circle->id]) }}">一覧</a></li>
            </ul>
        </div>
    </div>
@endsection