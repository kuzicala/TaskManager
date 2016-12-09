<?php

namespace App\Http\Controllers;

use App\Step;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;

class StepsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        return Task::findOrFail($id)->steps;
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
    public function store(Request $request,$id)
    {
        Task::findOrFail($id)->steps()->create([
            'name'=>$request->name,
            'completed'=>0
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
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

    public function complete($taskID){
            Task::findOrFail($taskID)->steps()->update([
                'completed'=> 1
            ]);
    }
    public function clear($taskID){
        Task::findOrFail($taskID)->steps()->delete();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $taskID,$id)
    {
        //
        $step = Step::findOrFail($id);
        $step->completed = $request->opposite;
        $step->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($taskid,$id)
    {
        Step::find($id)->delete();
    }
}
