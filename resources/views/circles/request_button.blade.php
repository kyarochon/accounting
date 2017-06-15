@if (Auth::user()->canRequest($circle->id))
    {!! Form::open(['route' => 'circle_user.request']) !!}
        {!! Form::hidden('circleId', $circle->id) !!}
        {!! Form::submit('Request', ['class' => 'btn btn-success']) !!}
    {!! Form::close() !!}
@elseif (Auth::user()->canCancelRequest($circle->id))
    {!! Form::open(['route' => 'circle_user.cancel_request', 'method' => 'delete']) !!}
        {!! Form::hidden('circleId', $circle->id) !!}
        {!! Form::submit('Cancel Request', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@elseif (Auth::user()->hasJoined($circle->id))
    <h4><span class="glyphicon glyphicon-ok" style="color:#00f">参加済</span></h4>
@elseif (Auth::user()->hasRejected($circle->id))
    <h4><span class="glyphicon glyphicon-remove" style="color:#000">却下済</span></h4>
@endif