@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-info pull-left" onclick="location.href='{{ route('circles.show', ['id' => $circle->id]) }}'">戻る</button>
        </div>
        <div class="col-xs-offset-1 col-xs-10" style="margin-top:20px;">
            <table class="table table-bordered table-hover table-striped">
                <tr>
			        <th>アカウント名</th>
			        <th>状態</th>
			        <th>管理</th>
		        </tr>
                @foreach ($users as $user)
                <tr>
                    <td><a href="{{ route('users.show', $user->id) }}">{{$user->name}}</a></td>
                    <td>{{$user->getStateText($user->pivot->state)}}</td>
                    
                    @if ($user->pivot->state == \Config::get('const.STATE_REQUEST'))
                    <td>
                        {!! Form::open(['route' => 'circle_user.accept_request']) !!}
                            {!! Form::hidden('circleId', $circle->id) !!}
                            {!! Form::hidden('userId', $user->id) !!}
                            {!! Form::submit('承認', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                        {!! Form::open(['route' => 'circle_user.reject_request']) !!}
                            {!! Form::hidden('circleId', $circle->id) !!}
                            {!! Form::hidden('userId', $user->id) !!}
                            {!! Form::submit('却下', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                    @elseif ($user->id == \Auth::user()->id && sizeof($users) > 1 && $user->pivot->state == \Config::get('const.STATE_JOIN'))
                    <td>
                        {!! Form::open(['route' => 'circle_user.leave']) !!}
                            {!! Form::hidden('circleId', $circle->id) !!}
                            {!! Form::hidden('userId', $user->id) !!}
                            {!! Form::submit('退会', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                    @else
                    <td></td>
                    @endif
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection