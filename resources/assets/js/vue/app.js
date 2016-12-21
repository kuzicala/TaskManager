// var  Vue = require('vue');
import Vue from "vue";
import VueResource from "vue-resource";
// var VueResource = require('vue-resource');
var stepList = require('./componets/stepList.vue');
Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = $('#token').attr('content');
var resource = Vue.resource(top.location+'/steps{/id}');
var app = new Vue({
    el:'#app',
    data:{
        steps:[
            {name:'', completed:false}
        ],
        baseUrl:top.location+'/steps'
    },
    beforeCreate:function () {

    },
    mounted:function () {
        this.$nextTick(function () {
            // 保证 this.$el 已经插入文档
            this.fetchSteps();
        });
    },
    components:{ stepList },
    methods:{
        fetchSteps:function () {
            resource.query().then((response) => {
                this.$set(this,'steps',response.body);
        }, (response) => {
                alert(response.status);
                // error callback
            });
        },
        addStep:function (step) {
            resource.save('', {name: step}).then((response) => {

                this.fetchSteps();
            }, (response) => {
                // error callback
            });
        },
        toggleCompletion:function (step) {
            resource.update({id:step.id},{opposite:!step.completed}).then((response)=> {
                this.fetchSteps();
        },(response)=> {
                response.status;
            });
        },
        removeStep:function (step) {
            resource.delete({id:step.id}).then((response)=> {
                this.fetchSteps();
        },(response)=> {
                response.status;
            });
        },


        completeAll:function () {
            this.$http.post(this.baseUrl+'/complete').then((response)=> {
                this.fetchSteps();
        },(response)=> {
                response.status;
            });
        },
        clearCompleted:function () {
            this.$http.delete(this.baseUrl+'/clear').then((response)=> {
                this.fetchSteps();
        },(response)=> {
                response.status;
            });
        }
    }


});