@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        @if($projects)
            @foreach($projects as $project)
                    <div class="col-sm-6 col-md-3">
                        <div class="thumbnail">
                            <ul class="icon-bar">
                                <li>@include('projects._deleteForm')</li>
                                <li>
                                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#editModal-{{$project->id}}">
                                        <i class="fa fa-btn fa-cog"></i>
                                    </button>
                                </li>
                            </ul>
                            <a href="{{route('projects.show',$project->name)}}"><img src="{{asset('thumbnail/'.$project->thumbnail)}}" alt="{{$project->name}}"></a>
                            <div class="caption">
                                <a href="{{route('projects.show',$project->name)}}"><h4 class="text-center">{{$project->name}}</h4></a>
                            </div>
                            @include('projects._editModel')
                        </div>
                    </div>
            @endforeach
        @endif
        <div class="project-modal col-sm-6 col-md-3">
            @include("projects/_createProjectModal")
        </div>
    </div>
</div>
@endsection
@section('customJS')
    @parent
    <script>
        $(function () {
            $(".icon-bar").hide();
            $(".thumbnail").hover(function () {
                $(this).find('.icon-bar').toggle();
            });
        })
    </script>
@endsection
