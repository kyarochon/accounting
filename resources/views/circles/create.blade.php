@extends('layouts.app')

@section('content')
    {!! Form::model($circle, ['route' => 'circles.store']) !!}

        <div class="form-group">
        {!! Form::label('name', 'サークル名', ['class' => 'input-lg']) !!}
        {!! Form::text('name', '', ['class' => 'form-control input-lg']) !!}

        {!! Form::label('image_name', '画像生成用文字列', ['class' => 'input-lg']) !!}
        {!! Form::text('image_name', '', ['class' => 'form-control input-lg']) !!}
        </div>
        
        {!! Form::submit('作成', ['class' => 'btn btn-success btn-lg']) !!}

    {!! Form::close() !!}

@endsection