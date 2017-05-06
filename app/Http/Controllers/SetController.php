<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Set;

use Auth;
use DB;

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
    public function store(Request $request)
    {
        
        session(['count' => 0]);
    	$set = new Set();
    	$set->user_id = Auth::user()->id;
    	$set->tasklist_id = $request->tl_id;
    	$set->save();
    	
        Set::createData($set->id);
        
        $taskNumber = 1;
        
        return redirect()->route('sets.show', ['id' => $set->id, 'taskNumber' => $taskNumber]);
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
        $opiskelijat = DB::select('select * from opiskelijat'.$set->id);
        $kurssit = DB::select('select * from kurssit'.$set->id);
        $suoritukset = DB::select('select * from suoritukset'.$set->id);
        
        return view('sets.show')->with(compact('set', 'taskNumber', 'opiskelijat', 'kurssit', 'suoritukset'));
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
        $set = Set::find($id);
        $set->destroyData();
        $set->delete();
        
        
    }
    
    public function timeout($id) {
        $set = Set::find($id);
        $set->destroyData();
        return redirect()->route('home');
    }
    
    public function destroyTables($id) {
        $set = Set::find($id);
        $set->destroyData();
        return redirect()->route('home');
    }

}
