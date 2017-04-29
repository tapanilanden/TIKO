<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use Illuminate\Support\Facades\Auth;
use Session;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        
        return view('tasks.index')->withTasks($tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, array(
            'description' => 'required|min:10',
            'type' => 'required',
            'model_query' => 'required|min:10|max:200'
        ));
        
        $task = new Task;
        $task->user_id = Auth::user()->id;
        $task->description = $request->description;
        $task->type = $request->type;
        $task->model_query = $request->model_query;
        $task->save();
           
        return redirect()->action('TaskController@index')->with('success', 'Tehtävä tallennettu!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task = Task::find($id);
        return view('tasks.show')->withTask($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::find($id);
        
        return view('tasks.edit')->withTask($task);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $task = Task::find($id);
        
        $this->validate($request, array(
            'description' => 'required|min:10',
            'type' => 'required',
            'model_query' => 'required|min:10|max:200'
        ));
        
        $task = Task::find($id);
        $task->description = $request->input('description');
        $task->model_query = $request->input('model_query');
        $task->type = $request->input('type');
        $task->user_id = Auth::user()->id;
        
        $task->save();
        

        return redirect()->route('tasks.index')->with('success', 'Muokkaus onnistui!');

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        
        return redirect()->route('tasks.index')->with('success', 'Tehtävä poistettiin onnistuneesti!');
    }
}
