@extends('layouts.app')
@section('content')
    <div class="col-md-8 col-md-offset-2">
    <div class="col-md-4">
        <canvas id="pieChart" width="300" height="300"></canvas>
        <div id="pie" data-todocount={{$toDoCount}} data-donecount={{$DoneCount}} data-total={{$total}}></div>
    </div>
    <div class="col-md-4">
        <canvas id="barChart" width="300" height="300"></canvas>
        <div id="bar" data-names={{json_encode($names,JSON_UNESCAPED_UNICODE)}} data-projects={{ json_encode(TasksCountArray($projects))}}></div>
    </div>
    <div class="col-md-4">
        <canvas id="radar" width="300" height="300"></canvas>
        {{--<div id="radar" data-names={{json_encode($names,JSON_UNESCAPED_UNICODE)}} data-projects={{ json_encode(TasksCountArray($projects))}}></div>--}}
    </div>
    </div>
@endsection

@section('customJS')
    <script src="{{asset('js/charts.js')}}"></script>
<script>
    var data = {
        labels: ["总数", "未完成", "已完成"],
        datasets: [
                <?php
                    $i = 0;
                    foreach($projects as $project):
                    $name = $project->name;
                    $total = $project->tasks()->count();
                    $todo = $project->tasks()->where('completed',0)->count();
                    $done = $project->tasks()->where('completed',1)->count();
                    echo "{";
                ?>
                label: "<?php echo $name ?>",
                backgroundColor: "{{ rand_color() }}",
                borderColor: "{{rand_color()}}",
                pointBackgroundColor: "{{rand_color()}}",
                pointBorderColor: "#fff",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "{{rand_color()}}",
                data: [ <?php echo $total.','.$todo.','.$done ?> ]
            <?php
                ($i+1) == $projects->count() ? print '}': print '},';
                $i++;
                endforeach;
            ?>
        ]
    };
    var radar = $("#radar");
    var myRadarChart = new Chart(radar, {
        type: 'radar',
        data: data,
        options: {
            responsive:true,
            title:{
                display:true,
                text:'任务总数对比'
            },
            legend:{
                diplay:false
            }
        }
    });
</script>

@endsection