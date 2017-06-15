@if ($circles)
    <div class="row">
        @foreach ($circles as $circle)
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        {!! link_to_route('circles.show', $circle->name, ['id' => $circle->id]) !!}
                    </div>
                    <div class="panel-body">
                        <img class="media-object img-rounded img-responsive center-block" src="{{ Gravatar::src($circle->name . $circle->image_name, 200) }}" alt="">
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif