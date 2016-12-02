<?php
namespace App\Http\ViewComposer;
use App\Repositories\TaskReposity;
use \Illuminate\View\View;
class TaskCountComposer{

    public function __construct(TaskReposity $task)
    {
        $this->task = $task;
    }

    public function compose(View $view){
        $view->with(
            [
                'total'=>$this->task->total(),
                'toDo'=>$this->task->toDoCount(),
                'Done'=>$this->task->doneCount()
            ]
        );
    }
}
