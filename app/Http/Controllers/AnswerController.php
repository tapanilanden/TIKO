<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Answer;
use App\Set;
use App\Task;
use Session;
use DB;

class AnswerController extends Controller
{
    
        /**
     * Apufunktio tehtävien tarkistukseen
     *
     *
     */
     
     public function checkAnswer($answer, $task) {
        try {

            $answerQuery = $answer->body;
            $modelQuery = $task->model_query;

            if (($task->type === 1 && stripos($answer, 'SELECT') !== false)
            || ($task->type === 2 && stripos($answer, 'INSERT') !== false)
            || ($task->type === 3 && stripos($answer, 'UPDATE') !== false)
            || ($task->type === 4 && stripos($answer, 'DELETE') !== false)) {

                if ((stripos($answer, 'opiskelijat') !== false)
                || (stripos($answer, 'kurssit') !== false)
                || (stripos($answer, 'suoritukset') !== false)) {

                    $original = array("opiskelijat", "kurssit", "suoritukset");
                    $modified = array("opiskelijat".$answer->set_id, "kurssit".$answer->set_id, "suoritukset".$answer->set_id);

                    $answerQuery = str_replace($original, $modified, $answerQuery);
                    $modelQuery = str_replace($original, $modified, $modelQuery);

                    $answerQuery = DB::select($answerQuery);
                    $modelQuery = DB::select($modelQuery);

                }

                return ($answerQuery == $modelQuery)? true : false;

            }
            
            else
                return false;
        }
        catch(QueryException $e) {
            return false;
        }
     }
     
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $answers = Answer::all();
        return view('answers.index')->withAnswers($answers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('answers.create');
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
            'answer' => 'required|min:10',
        ));
        
        $answer = new Answer;
        $answer->set_id = $request->set_id;
        $answer->task_id = $request->task_id;
        $answer->iscorrect = true;
        $answer->body = $request->answer;
        
        $answer->save();
        
        //Tehtävän tarkistus
        $task = Task::find($request->task_id);
        $answer->iscorrect = AnswerController::checkAnswer($answer, $task);
        $answer->save();
        
        $taskNumber = $request->taskNumber;
        if ($answer->iscorrect == true) {
            $taskNumber += 1;
            Session::flash('success', 'Vastaus on oikein');
        }
        else {
            Session::flash('error', 'Vastaus on väärin');
        }
        
        if($taskNumber <= $request->taskCount)
            return redirect()->route('sets.show', ['set' => $answer->set_id, 'taskNumber' => $taskNumber]);
        else { 
            $set = Set::find($answer->set_id);
            $set->destroyData();
            return redirect()->route('home');
        }
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
