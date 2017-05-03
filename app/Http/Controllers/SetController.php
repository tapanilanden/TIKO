<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Set;

use Auth;

class SetController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sets = Set::all();
        
        return view('sets.index')->withSets($sets);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id, Request $request)
    {

    	$set = new Set();
    	$set->user_id = Auth::user()->id;
    	$set->tasklist_id = $id;
    	$set->save();
    	
        Set::createData($set->id);

        $taskNumber = 1;

        return redirect()->action('SetController@show', ['id' => $set->id, 'taskNumber' => $taskNumber]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $taskNumber)
    {
        $set = Set::find($id);
        return view('sets.show')->with(compact('set', 'taskNumber'));
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
