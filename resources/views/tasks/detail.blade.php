@extends('layouts.app')
@section('customHeader')
    <meta id="token" name="token" content="{{csrf_token()}}">
@endsection
@section('content')
    <div id="app" class="container">
        <h1 class="text-muted">{{$task->title}}</h1>
        <step-list :steps="steps"  v-on:toggle="toggleCompletion" v-on:remove="removeStep" v-on:new="addStep" v-on:complete="completeAll" type="remaings"></step-list>
        <step-list :steps="steps"  v-on:toggle="toggleCompletion" v-on:remove="removeStep"  v-on:clear="clearCompleted" type="completed"></step-list>
    </div>
@endsection
@section('customJS')
    <script src="{{asset('js/app.js')}}"></script>
    @parent
@endsection