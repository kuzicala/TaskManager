@extends('layouts.app')
@section('customHeader')
    <meta id="token" name="token" content="{{csrf_token()}}">
@endsection
@section('content')
    <div id="app" class="container">
        <h1 class="text-muted">{{$task->title}}</h1>
        <h2 v-if="remainings.length">未完成步骤(@{{ remainings.length }})
        <span class="btn btn-sm btn-info" @click="completeAll()">完成所有
        </span>
        </h2>
            <ul class="list-group">
                <step-list v-for="step in inProcess(steps)" :step="step" v-on:edit="editStep(step)" v-on:toggle="toggleCompletion(step)" v-on:remove="removeStep(step)"></step-list>
            </ul>
        <form @submit.prevent = "addStep" class="form-inline">
            <div class="form-group col-md-8">
                <label v-if="!newStep">完成该任务(Task)需要哪些步骤呢?</label>
                <input type="text" v-model="newStep" class="form-control" ref="newStep" placeholder="I need to...">
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-default btn-success" v-if="newStep">添加步骤</button>
            </div>
        </form>
<div class="clearfix"></div>
        <h2 v-if=" completation.length">完成步骤(@{{ completation.length }})<span class="btn btn-sm btn-info" @click="clearCompleted()">清除所有已完成</h2>
        <ul class="list-group">
            <li class="list-group-item" v-for="step in inCompleted(steps) " @dblclick="editStep(step)">
            <span @dblclick="editStep(step)">@{{step.name}}</span>
                <span class="pull-right">
                     <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                    <i class="fa fa-close" @click="removeStep(step)"></i>
                </span>

            </li>
        </ul>
    </div>
@endsection
@section('customJS')
    <script src="{{asset('js/app.js')}}"></script>
@endsection