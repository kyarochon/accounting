@extends('layouts.app')

@if (!Auth::check())
    @section('cover')
        <div class="cover">
            <div class="cover-inner">
                <div class="cover-contents">
                    <h1>会計管理をより簡単に</h1>
                </div>
            </div>
        </div>
    @endsection
@else
    @section('content')
        @include('circles.circles', ['circles' => $circles])
    @endsection
@endif
    

