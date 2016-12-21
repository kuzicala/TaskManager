<template>
        <div class="col-md-4 col-md-offset-1">
            <div class="panel panel-default" v-if="show">
                <div class="panel-heading">
                    <h2 v-if="remainings.length && type == 'remaings'">未完成步骤({{ remainings.length }})
                        <span class="btn btn-sm btn-info" @click="completeAll()">完成所有
                        </span>
                    </h2>
                    <h3 v-if=" completation.length && type == 'completed'">已完成的步骤({{ completation.length }})<span class="btn btn-sm btn-danger" @click="clearCompleted()">清除所有已完成</h3>
                </div>
                <div class="panel-body">
                    <ul class="list-group">
                      <transition-group name="list">
                        <li class="list-group-item"  v-for="step in typeSwitch(steps)" :key="'id-' + step.id">
                            <span @dblclick="editStep(step)">{{step.name}}</span>
                                 <span class="pull-right">
                                    <i class="fa fa-check" @click="toggleCompletion(step)"></i>
                                     <i class="fa fa-close" @click="removeStep(step)"></i>
                                 </span>
                        </li>
                       </transition-group>
                    </ul>
                </div>
            </div>

            <div class="panel panel-default" v-if="type == 'remaings'">
                <div class="panel-heading">
                    <form @submit.prevent = "addStep" class="form">
                        <div class="form-group">
                            <label v-if="!newStep">完成该任务(Task)需要哪些步骤呢?</label>
                            <input type="text" v-model="newStep" class="form-control" ref="newStep" placeholder="I need to...">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-default btn-success" v-if="newStep">添加步骤</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

</template>
<script>
    export default{
        props:['steps','type'],
        data:function(){
            return {
                newStep:''
            }
        },
        methods:{
            editStep:function (step) {
                this.removeStep(step);
                this.newStep = step.name;
                this.$refs.newStep.focus();
            },
            typeSwitch:function(steps){
                var vm = this;
                if(vm.type == 'remaings'){
                       return vm.inProcess(steps);
                }
                return  vm.inCompleted(steps);
            },
            toggleCompletion:function(step){
                   this.$emit('toggle',step);
            },
           removeStep:function(step){
                   this.$emit('remove',step);
            },
          inProcess:function (steps) {
                    return steps.filter(function (step) {
                        return step.completed != true;
                    })
                },
           addStep:function(){
                      this.$emit('new',this.newStep);
                           this.newStep = '';
           },
           inCompleted:function (steps) {
               return steps.filter(function (step) {
                   return  step.completed == true;
               })
           },
           completeAll:function(){
                         this.$emit('complete');
              },
          clearCompleted:function(){
                          this.$emit('clear');
               },
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
            },
            show:function(){
                var case1 = this.remainings.length && this.type == 'remaings';
                var case2 = this.completation.length && this.type == 'completed';
                if(case1 || case2){
                        return true;
                }
            }
        }
    }
</script>

<style>
        .list-enter-active, .list-leave-active {
          transition: all .8s ease;
        }
        .list-enter, .list-leave-active {
          opacity: 0;
        }
</style>