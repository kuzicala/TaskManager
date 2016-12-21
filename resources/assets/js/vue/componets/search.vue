<template>
    <form action="" class="navbar-form navbar-left" role="search">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search"  @focus="fetchTasks()" @blur="leave" v-model="searchStr">
                <div class="input-group-addon"><i class="fa fa-search"></i> </div>
            </div>
        </div>
        <ul class="list-group search-list" v-if="show">
            <li class="list-group-item" v-for="task in tasks"  >
                <a :href="link(task)"><p>{{task.title}}</p></a>
            </li>
        </ul>
    </form>
</template>
<script>
    export default{
        data:function(){
            return {
                tasks:[],
                searchStr:'',
                show:true
            }
        },
        methods:{
            fetchTasks:function(){
                this.$http.get('/tasks/search').then((response)=>{
                    this.$set(this,'tasks',response.body);
                this.show = true;
                },(response)=>{})
            },
            leave:function () {
               var vm = this;
                setTimeout(function () {
                    vm.show = false;
                },300)

            },
            link:function(task){
                return "/tasks/"+task.id
            },
//            checkTasks:function (tasks) {
//                return tasks.filter(function (task) {
//                    if(task.title.indexOf(searchStr) != -1){
//                        return task;
//                    }
//                })
//            }
        }
    }
</script>

<style>
    .navbar-default .navbar-collapse, .navbar-default .navbar-form{
        height:3em;
    }
    .navbar-form  .search-list{
        height: 28em;
        overflow: auto;
        position: absolute;
        z-index:-1;
    }

</style>