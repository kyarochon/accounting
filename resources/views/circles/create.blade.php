@extends('layouts.app')

@section('content')

    <h1>サークル新規作成ページ</h1>

    {!! Form::model($circle, ['route' => 'circles.store']) !!}

        {!! Form::label('name', 'サークル名:') !!}
        {!! Form::text('name') !!}

        {!! Form::label('image_name', 'アイコン:') !!}
        {!! Form::text('image_name') !!}
        
        {!! Form::submit('投稿') !!}

    {!! Form::close() !!}

@endsection