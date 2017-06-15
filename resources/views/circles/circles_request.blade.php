@if ($circles)
    <div class="row" style="margin-top:20px;">
        @foreach ($circles as $circle)
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        {{$circle->name}}
                    </div>
                    <div class="panel-body">
                        <p class="item-title">
                            <img class="media-object img-rounded img-responsive center-block" src="{{ Gravatar::src($circle->name . $circle->image_name, 200) }}" alt="">
                        </p>
                        <div class="buttons text-center">
                            @if (Auth::check())
                                @include('circles.request_button', ['circle' => $circle])
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif