{!! Form::open(['route'=>['tasks.check','project'=>$task->id],'method'=>'post']) !!}
<button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i></button>
{!! Form::close() !!}