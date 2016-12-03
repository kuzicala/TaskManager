@extends('layouts.app')
@section('content')
    <div class="col-md-4">
        <canvas id="pieChart" width="300" height="300"></canvas>
        <div id="pie" data-todocount={{$toDoCount}} data-donecount={{$DoneCount}} data-total={{$total}}></div>
    </div>
    <div class="col-md-4">
        <canvas id="barChart" width="300" height="300"></canvas>
        <div id="bar" data-names={{json_encode($names,JSON_UNESCAPED_UNICODE)}} data-projects={{ json_encode(TasksCountArray($projects))}}></div>
    </div>
@endsection

@section('customJS')
    <script src="{{asset('js/charts.js')}}"></script>
@endsection