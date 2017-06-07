@if ($circles)
    <div class="row">
        @foreach ($circles as $circle)
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        画像が入る
                    </div>
                    <div class="panel-body">
                        <p class="item-title">
                            {{$circle->name}}
                        </p>
                        <div class="buttons text-center">
                            @if (Auth::check())
                                ボタンが入る
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif