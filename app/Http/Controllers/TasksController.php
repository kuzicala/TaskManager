<?php

namespace App\Http\Controllers;

use App\Project;
use App\Repositories\TaskReposity;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TasksController extends Controller
{

    protected $task = null;
    public function __construct(TaskReposity $task)
    {
            $this->task = $task;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $toDo = Auth::user()->tasks()->where('completed',0)->paginate(3);
       $Done =  Auth::user()->tasks()->where('completed',1)->paginate(3);
        $projects = Auth::user()->projects()->lists('name','id');
        return view('tasks.index',compact('toDo','Done','projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\CreateTaskRequest $request)
    {
        Task::create([
            'title'=>$request->name,
            'project_id'=>$request->project,
        ]);
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::findOrFail($id);
        return view('tasks.detail',compact('task'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\EditTaskRequest $request, $id)
    {
            $task = Task::findOrFail($id);
            $task->title = $request->title;
            $task->project_id = $request->projectList;
            $task->save();
            return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Task::find($id)->delete();
        return Redirect::back();
    }
    public function check($id)
    {
        $task =Task::findOrFail($id);
        $task->completed = 1;
        $task->save();
        return redirect::back();
    }

    public function charts(){
        $total = $this->task->total();
        $toDoCount = $this->task->toDoCount();
        $DoneCount = $this->task->doneCount();
        $names = Auth::user()->projects()->lists('name');
        $projects = Project::with('tasks')->get();
        return view('tasks.charts',compact('total','toDoCount','DoneCount','names','projects'));
    }
}
