var Vue = require('vue');
var VueResource = require('vue-resource');
var StepList = require('./components/stepList.vue');

Vue.use(VueResource);

Vue.http.headers.common['X-CSRF-TOKEN'] = $('#token').attr('content');
var resource = Vue.resource(top.location+'/steps{/id}');
Vue.transition('fade',{
	enterClass: 'fadeIn',
});

new Vue({
	el:'#app',
	data:{
		steps:[
			{name:'', completed:false}
		],
		baseURL:self.location+'/steps'
	},
	ready:function(){
		this.fetchSteps();
	},
	components:{ StepList },
	methods:{
		fetchSteps:function(){
			resource.query().then((response)=>{
				//success
				this.$set('steps', response.body);
			},(response)=>{
				//error
				response.status;
			});
		},
		addStep:function(step){
			resource.save('', {name:step}).then((response)=>{
				//success
				this.fetchSteps();

			},(response)=>{
				//error
				response.status;
			});
		},
		removeStep:function(step){
			resource.delete({id:step.id}).then((response)=>{
				//success
				this.fetchSteps();
			},(response)=>{
				//error
				response.status;
			});
		},
		toggleCompletion:function(step){

			resource.update({id:step.id}, {opposite: !step.completed}).then((response)=>{
				//success
				this.fetchSteps();
			},(response)=>{
				//error
				response.status;
			});
		},
		completeAll:function(){
			this.$http.post(this.baseURL+'/complete').then((response)=>{
				//success
				this.fetchSteps();
			},(response)=>{
				//error
				response.status;
			});
		},
		clearCompeted:function(){
			this.$http.delete(this.baseURL+'/clear').then((response)=>{
				//success
				this.fetchSteps();
			},(response)=>{
				//error
				response.status;
			});
		}
	}
})