@extends('layouts.app')
@section('content')
    <div class="container tasks-tabs">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#toDo" role="tab" data-toggle="tab" >未完成</a></li>
            <li role="presentation"><a href="#Done" role="tab" data-toggle="tab">已完成</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="toDo">
                {{--未完成--}}
                <table class="table table-striped">
                    <thead>
                    <tr>
                        @include('tasks._createForm')
                    </tr>
                    </thead>

                    @foreach($toDo as $task)
                        <tr>
                            <td class="date-cell">{{$task->updated_at->diffForHumans()}}</td>
                            {{--<td class="first-cell">{{$task->title}}</td>--}}
                           <td class="first-cell">{{link_to_route('tasks.show',$task->title,$task->id)}}</td>
                          <td class="icon-cell">@include('tasks._checkForm')</td>
                        <td class="icon-cell">@include('tasks._editForm')</td>
                        <td class="icon-cell">@include('tasks._deleteForm')</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div role="tabpanel" class="tab-pane" id="Done">
                {{--完成--}}
                <table class="table table-striped">
                    @foreach($Done as $task)
                        <tr><td>{{$task->title}}</td></tr>
                    @endforeach
                </table>
            </div>
        </div>
        @if($errors->has('name'))
            <ul class="alert alert-danger">
                @foreach($errors->get('name') as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

    </div>
@endsection