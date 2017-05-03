<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Answer;

use Session;

class AnswerController extends Controller
{
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
        
        $taskNumber = $request->taskNumber;
        if ($answer->iscorrect == true) {
            $taskNumber += 1;
            Session::flash('success', 'Vastaus on oikein');
        }
        else {
            Session::flash('error', 'Vastaus on väärin');
        }
        
        return redirect()->route('sets.show', ['set' => $answer->set_id, 'taskNumber' => $taskNumber]);
        
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
