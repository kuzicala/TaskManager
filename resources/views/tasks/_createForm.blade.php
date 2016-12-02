{!! Form::open(['route'=>['tasks.store','project'=>$project->id],'method'=>'post','class'=>'form-inline']) !!}
<td class="first-cell">
    {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'有什么要完成的任务吗']) !!}
</td>
<td class="icon-cell">
    <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i></button>
</td>
{!! Form::close() !!}