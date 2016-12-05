@extends('layouts.app')
@section('content')
    <div id="app" class="container">
        <h2 v-if="remainings.length">未完成步骤(@{{ remainings.length }})
        <span class="btn btn-sm btn-info" @click="completeAll()">完成所有
        </span>
        </h2>
            <ul class="list-group">
                <li class="list-group-item" v-for="step in inProcess(steps)" >
                    <span @dblclick="editStep(step)">@{{step.name}}</span>
              <span class="pull-right">
                <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                 <i class="fa fa-close" @click="removeStep(step)"></i>
                </span>
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
            <li class="list-group-item" v-for="step in inCompleted(steps) " @dblclick="editStep">
            <span @dblclick="editStep(step)">@{{step.name}}</span>
                <span class="pull-right">
                     <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                    <i class="fa fa-close" @click="removeStep(step)"></i>
                </span>

            </li>
        </ul>
       <pre> @{{$data | json}}</pre>
    </div>
@endsection
@section('customJS')
    <script src="{{asset('js/vue.js')}}"></script>
    <script>
        var app = new Vue({
            el:'#app',
            data:{
                steps:[
                    {name:'洗衣服',completed:false},
                    {name:'睡觉',completed:false}
                ],
                newStep:''
            },
            methods:{
                addStep:function () {
                    this.steps.push({name:this.newStep,completed:false});
                    this.newStep = '';
                },
                toggleCompletion:function (step) {
                    step.completed = !step.completed;
                },
                removeStep:function (step) {
                    this.steps.splice(this.steps.indexOf(step),1);
                },
                editStep:function (step) {
                    this.removeStep(step);
                    this.newStep = step.name;
                    this.$refs.newStep.focus();
                },
                inProcess:function (steps) {
                    return steps.filter(function (step) {
                        return step.completed != true;
                    })
                },
                inCompleted:function (steps) {
                    return steps.filter(function (step) {
                        return  step.completed == true;
                    })
                },
                completeAll:function () {
                    this.steps.forEach(function (step) {
                        step.completed = true;
                    })
                },
                clearCompleted:function () {
                    this.steps = this.steps.filter(function (step) {
                        return !step.completed;
                    })
                }
            },
            computed:{
                remainings:function () {
                    return this.steps.filter(function (step) {
                        return !step.completed;
                    })
                },
                completation:function () {
                    return this.steps.filter(function (step) {
                        return step.completed;
                    })
                }
            }

        });
    </script>
@endsection