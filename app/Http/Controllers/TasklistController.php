<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tasklist;

use App\Task;

use Auth;

use Input;

class TasklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasklists = Tasklist::all();
        
        return view('tasklists.index')->withTasklists($tasklists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks = Task::all();
        $tasklists = Tasklist::all();
        return view('tasklists.create')->withTasks($tasks)->withTasklists($tasklists);
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
            'body' => 'required|min:10'
        ));
        
        $tasklist = new Tasklist;
        $tasklist->user_id = Auth::user()->id;
        $tasklist->body = $request->body;
        $tasklist->save();

        foreach(Task::all() as $task) {

            if (Input::get($task->id) == 'on') {
                $tasklist->tasks()->attach($task->id);
            }
        }

        $tasklist->save();
        
        
        return redirect()->action('TasklistController@index')->with('success', 'Tehtävälista tallennettu!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tasklist = Tasklist::find($id);
        return view('tasklists.show')->withTasklist($tasklist);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasklist = Tasklist::find($id); 
        $tasks = Task::all();
        return view('tasklists.edit')->withTasklist($tasklist)->withTasks($tasks);
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
        
        $this->validate($request, array(
            'body' => 'required|min:10'
        ));
        
        $tasklist = Tasklist::find($id);
        $tasklist->body = $request->input('body');

        foreach(Task::all() as $task) {

            $found = true;

            foreach($tasklist->tasks as $list_task) {
                if (Input::get($task->id) == 'on' && $list_task->id == $task->id) {
                    $tasklist->tasks()->detach($task->id);
                    $found = true;
                    break;
                }
                else if (Input::get($task->id) == 'on' && $list_task->id != $task->id) {
                    $found = false;
                }
            }
            if ($tasklist->tasks->isEmpty() && Input::get($task->id) == 'on' || $found == false) {
                $tasklist->tasks()->attach($task->id);
            }

        }
        
        $tasklist->save();
        

        return redirect()->route('tasklists.index')->with('success', 'Muokkaus onnistui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
