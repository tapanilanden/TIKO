<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Answer;
use App\Set;
use App\Task;
use Session;
use DB;
use Carbon\Carbon;

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
                $helpTable = AnswerController::addIdToTableName($answerQuery, $answer, $modelQuery);
                $answerQuery = $helpTable['answerQuery'];
                $modelQuery = $helpTable['modelQuery'];
                $answer = $helpTable['answer'];

                
                $answerQuery = DB::select($answerQuery);
                
                $modelQuery = DB::select($modelQuery);

                if ($answerQuery == $modelQuery) {
                    Session::flash('success', 'Vastaus on oikein. Kyselysi tulos: ' . json_encode($answerQuery));
                } else {
                    Session::flash('error', 'Vastaus on väärin. Kyselysi tulos: ' . json_encode($answerQuery));
                }
                
                return ($answerQuery == $modelQuery)? true : false;
            }
            else if ($task->type === 2 && stripos($answer, 'INSERT') !== false) {
                $helpTable = AnswerController::addIdToTableName($answerQuery, $answer, $modelQuery);
                $answerQuery = $helpTable['answerQuery'];
                $modelQuery = $helpTable['modelQuery'];
                $answer = $helpTable['answer'];
                
                DB::beginTransaction();

                $answerQuery = DB::insert($answerQuery);
            
                $modelQuery = DB::select($modelQuery);
                
                if (empty($modelQuery)) {
                    DB::rollback();
                    return false;
                } else {
                    DB::commit();
                    return true;
                }
            
            }
            else if($task->type === 3 && stripos($answer, 'UPDATE') !== false) {
                $helpTable = AnswerController::addIdToTableName($answerQuery, $answer, $modelQuery);
                $answerQuery = $helpTable['answerQuery'];
                $modelQuery = $helpTable['modelQuery'];
                $answer = $helpTable['answer'];

                DB::beginTransaction();
                
                $answerQuery = DB::update($answerQuery);
                $modelQuery = DB::select($modelQuery);

                if (empty($modelQuery)) {
                    DB::rollback();
                    return false;
                } else {
                    DB::commit();
                    return true;
                }

            }
            else if ($task->type === 4 && stripos($answer, 'DELETE') !== false) {

                $helpTable = AnswerController::addIdToTableName($answerQuery, $answer, $modelQuery);
                $answerQuery = $helpTable['answerQuery'];
                $modelQuery = $helpTable['modelQuery'];
                $answer = $helpTable['answer'];

                if(stripos($task->modelAnswer->body, 'WHERE')) {
                    if(!stripos($answer->body, 'WHERE')) {
                        return false;
                    }
                }

                DB::beginTransaction();
                
                $answerQuery = DB::delete($answerQuery);
                $modelQuery = DB::select($modelQuery);

                if (!empty($modelQuery)) {
                    DB::rollback();
                    return false;
                } else {
                    DB::commit();
                    return true;
                }

            } else {
                return false;
            }
        }
        catch(\Illuminate\Database\QueryException $e) {
            Session::flash('error', $e->errorInfo[2]);
            DB::rollback();
            return false;
        }
     }
     
     public function addIdToTableName($answerQuery, $answer, $modelQuery = null) {
        
        if (stripos($answerQuery, 'opiskelijat') !== false) {

            $answerQuery = str_replace("opiskelijat", "opiskelijat".$answer->set_id, $answerQuery);

            
        }

        if (stripos($answerQuery, 'kurssit') !== false) {

            $answerQuery = str_replace("kurssit", "kurssit".$answer->set_id, $answerQuery);

            
        }

        if (stripos($answerQuery, 'suoritukset') !== false) {

            $answerQuery = str_replace("suoritukset", "suoritukset".$answer->set_id, $answerQuery);

            
        }

        if (stripos($modelQuery, 'opiskelijat') !== false) {

            $modelQuery = str_replace("opiskelijat", "opiskelijat".$answer->set_id, $modelQuery);
            
        }

        if (stripos($modelQuery, 'kurssit') !== false) {

            $modelQuery = str_replace("kurssit", "kurssit".$answer->set_id, $modelQuery);
            
        }

        if (stripos($modelQuery, 'suoritukset') !== false) {


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
        
       
        $tries = session('count');
        $tries++;
        session(['count' => $tries]);
        
        
        $taskNumber = $request->taskNumber;
        if ($answer->iscorrect == true) {
            $taskNumber += 1;
            if (!Session::has('success')) {
                Session::flash('success', 'Vastaus on oikein');
            }
            session(['count' => 0]);
        }
        else if ($tries >= 3) {
            $taskNumber += 1;
            Session::flash('error', "Yritykset loppuivat! Oikea vastaus: " . $task->modelAnswer->body);

            if ($task->type == 2) {
                $helpTable = AnswerController::addIdToTableName($task->modelAnswer->body, $answer);
                $query = $helpTable['answerQuery'];
                DB::insert($query);
                DB::commit();
            } else if ($task->type == 3) {
                $helpTable = AnswerController::addIdToTableName($task->modelAnswer->body, $answer);
                $query = $helpTable['answerQuery'];
                DB::update($query);
                DB::commit();
            } else if ($task->type == 4) {
                $helpTable = AnswerController::addIdToTableName($task->modelAnswer->body, $answer);
                $query = $helpTable['answerQuery'];
                DB::delete($query);
                DB::commit();
            }

            session(['count' => 0]);
            
        }
        else if (!Session::has('error')) {
            Session::flash('error', 'Vastaus on väärin');
        }
        
        if($taskNumber <= $request->taskCount)
            return redirect()->route('sets.show', ['set' => $answer->set_id, 'taskNumber' => $taskNumber]);
        else { 
            $set = Set::find($answer->set_id);
            $set->updated_at = Carbon::now();
            $set->save();
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
