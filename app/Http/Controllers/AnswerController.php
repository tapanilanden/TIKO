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

            if ($task->type === 1 && stripos($answer, 'SELECT') !== false) {
                $helpTable = AnswerController::addIdToTableName($answerQuery, $modelQuery, $answer);
                $answerQuery = $helpTable['answerQuery'];
                $modelQuery = $helpTable['modelQuery'];
                $answer = $helpTable['answer'];
                
                $answerQuery = DB::select($answerQuery);
                
                $modelQuery = DB::select($modelQuery);
                
                return ($answerQuery == $modelQuery)? true : false;
            }
            else if ($task->type === 2 && stripos($answer, 'INSERT') !== false) {
                $helpTable = AnswerController::addIdToTableName($answerQuery, $modelQuery, $answer);
                $answerQuery = $helpTable['answerQuery'];
                $modelQuery = $helpTable['modelQuery'];
                $answer = $helpTable['answer'];
                
                $answerQuery = DB::insert($answerQuery);
                //dd($answerQuery);
                
                
                
                return false;
            
            }
            else if($task->type === 3 && stripos($answer, 'UPDATE') !== false) {
            
            }
            else if ($task->type === 4 && stripos($answer, 'DELETE') !== false) {

                
                $answerQuery = DB::select($answerQuery);
                //dd($answerQuery);
                $modelQuery = DB::select($modelQuery);
                //var_dump($modelQuery);


                return ($answerQuery == $modelQuery)? true : false;

            } else {
                return false;
            }
        }
        catch(\Illuminate\Database\QueryException $e) {
            Session::flash('error', $e->errorInfo[2]);
            return false;
        }
     }
     
     public function addIdToTableName($answerQuery, $modelQuery, $answer) {
        
        if (stripos($answerQuery, 'opiskelijat') !== false) {

            $answerQuery = str_replace("opiskelijat", "opiskelijat".$answer->set_id, $answerQuery);
            $modelQuery = str_replace("opiskelijat", "opiskelijat".$answer->set_id, $modelQuery);
            
        }

        if (stripos($answerQuery, 'kurssit') !== false) {

            $answerQuery = str_replace("kurssit", "kurssit".$answer->set_id, $answerQuery);
            $modelQuery = str_replace("kurssit", "kurssit".$answer->set_id, $modelQuery);
            
        }

        if (stripos($answerQuery, 'suoritukset') !== false) {

            $answerQuery = str_replace("suoritukset", "suoritukset".$answer->set_id, $answerQuery);
            $modelQuery = str_replace("suoritukset", "suoritukset".$answer->set_id, $modelQuery);
            
        }
        return ['modelQuery' => $modelQuery, 'answerQuery' => $answerQuery, 'answer' => $answer];

     
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
            'answer' => 'required|min:10|has_semicolon|paired_parenthesis',
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
        else if (!Session::has('error')) {
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
