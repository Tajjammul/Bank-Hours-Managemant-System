<?php

namespace App\Http\Controllers;

use App\Tasks;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $tasks = Tasks::get();
        $tasks = DB::table('tasks as t')->select('t.*', 'p.name as project_name')
            ->leftJoin('projects as p', 't.project_id', '=', 'p.id')
            ->get();
        // echo '<pre>';
        // print_r($tasks);
        // echo '</pre>';
        // exit;
        return view('admin/tasks/list')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $projects = Project::get();
        $tasks = Tasks::get();
        return view('admin/tasks/form')->with('projects', $projects)->with('tasks', $tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $task = array(
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'progress' => $request->progress,
            'consumed_hours' => $request->consumed_hours,
            'consumed_mins' => $request->consumed_mins,
            'project_id' => $request->project,
            'parent_id' => $request->parent
        );
        Tasks::create($task);
        return redirect(url('tasks'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $projects = Project::get();
        $tasks = Tasks::get();
        $task = Tasks::where('id', $id)->first();
        return view('admin/tasks/form')
            ->with('projects', $projects)
            ->with('tasks', $tasks)
            ->with('update', true)
            ->with('task', $task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $task = array(
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'progress' => $request->progress,
            'consumed_hours' => $request->consumed_hours,
            'consumed_mins' => $request->consumed_mins,
            'project_id' => $request->project,
            'parent_id' => $request->parent
        );
        Tasks::where('id', $id)->update($task);
        $request->session()->flash('success', 'Task updated successfuly');
        return redirect(url('tasks/' . $id . '/edit'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Tasks::where('id', $id)->delete();
        return redirect(url('tasks'));
    }
}
