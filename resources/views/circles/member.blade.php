@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-info pull-left" onclick="location.href='{{ route('circles.show', ['id' => $circle->id]) }}'">戻る</button>
        </div>
        <div class="col-xs-offset-1 col-xs-10" style="margin-top:20px;">
            <table class="table table-bordered table-hover table-striped">
                <tr>
			        <th>氏名</th>
			        <th>アドレス</th>
			        <th>メンバータイプ</th>
			        <th>ボタンとか</th>
		        </tr>
                @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->getStateText($user->pivot->state)}}</td>
                    <td>ボタンが入る</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection