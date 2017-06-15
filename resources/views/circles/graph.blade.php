@extends('layouts.app')

@section('content')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <div class="row">
        <div class="col-xs-12">
            <button class="btn btn-info pull-right" onclick="location.href='{{ route('circles.member', ['id' => $circle->id]) }}'">メンバー管理</button>
        </div>
        <div class="col-xs-12" style="margin-top:20px;">
            <ul class="nav nav-tabs nav-justified">
                <li role="presentation" class="{{ Request::is('circles/' . $circle->id) ? 'active' : '' }}"><a href="{{ route('circles.show', ['id' => $circle->id]) }}">収支</a></li>
                <li role="presentation" class="{{ Request::is('circles/*/graph') ? 'active' : '' }}"><a href="{{ route('circles.graph', ['id' => $circle->id]) }}">グラフ</a></li>
                <li role="presentation" class="{{ Request::is('circles/*/list') ? 'active' : '' }}"><a href="{{ route('circles.list', ['id' => $circle->id]) }}">一覧</a></li>
            </ul>
        </div>
        <div class="col-xs-6" style="margin-top:20px;">
            <h1 class="text-center"><span class="label label-info">収入</span></h1>
            <canvas id="incomeCanvas" style="margin-top:5px;"></canvas>
        </div>
        <div class="col-xs-6" style="margin-top:20px;">
            <h1 class="text-center"><span class="label label-warning">支出</span></h1>
            <canvas id="spendingCanvas" style="margin-top:5px;"></canvas>
        </div>
        
        
        <script>
            // 円グラフ描画共通処理
            var drawPieChart = function(canvasName, data, labels, bgColors) {
                var context = document.getElementById(canvasName).getContext('2d');
                var pieChart = new Chart(context, {
                    type: 'pie',
                    data: {
                        labels: labels,
                        datasets: [{
                            backgroundColor: bgColors,
                            data: data,
                        }]
                    },
                    options: {
                        tooltips: {
                            callbacks: {
                                label: function (tooltipItem, data) {
                                    return data.labels[tooltipItem.index]
                                    + ": "
                                    + data.datasets[0].data[tooltipItem.index]
                                    + " 円"; //ここで単位を付けます
                                }
                            }
                        }
                    }
                });
            }
            
            // 収入
            var incomeList     = <?php echo json_encode($income_list, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
            var incomeLabels   = <?php echo json_encode($income_labels, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
            var bgColors = [
                "#2ecc71",  // 緑
                "#3498db",  // 青
                "#34495e",  // 紺
                "#9b59b6",  // 紫
                "#f1c40f",  // 黄
                "#e74c3c",  // 赤
            ];
            drawPieChart("incomeCanvas", incomeList, incomeLabels, bgColors );


            // 支出
            var spendingList   = <?php echo json_encode($spending_list, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
            var spendingLabels = <?php echo json_encode($spending_labels, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>;
            var bgColors = [
                "#e74c3c",  // 赤
                "#f1c40f",  // 黄
                "#9b59b6",  // 紫
                "#34495e",  // 紺
                "#3498db",  // 青
                "#2ecc71",  // 緑
            ];
            drawPieChart("spendingCanvas", spendingList, spendingLabels, bgColors );
        </script>
    </div>
@endsection



