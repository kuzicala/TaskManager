{!! Form::open(['route'=>['tasks.destroy',$task->id],'method'=>'delete']) !!}
<button type="submit" class="btn btn-danger">
    <i class="fa fa-close"></i>
</button>
{!! Form::close() !!}