<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        
        return view('users.index')->withUsers($users);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        
        return view('users.edit')->withUser($user);
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
        try {
            $this->validate($request, array(
                'name' => 'required|string|max:255',
                'ppt' => 'required|string',
                'email' => 'required|string|email|max:255'
            ));
            
            $user = User::find($id);
            $user->name = $request->input('name');
            $user->ppt = $request->input('ppt');
            $user->email = $request->input('email');
            $user->major = $request->input('major');
            
            $user->save();

            return redirect()->route('users.index')->with('success', 'Muokkaus onnistui!');
        }
        catch(\Illuminate\Database\QueryException $e) {
            Session::flash('error', $e->errorInfo[2]);
            return redirect()->back()->with('error', 'Peruspalvelutunnus tai sähköpostiosoite on jo käytössä.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        
        return redirect()->route('users.index')->with('success', 'Käyttäjä poistettu onnistuneesti!');
    }


      public function makeMod(Request $request){
      $id = $request->input('id');
      $user = User::find($id);

      // redirect
      $user->role = 2;
      $user->save();
      session()->flash('message', 'Opettajan oikeudet annettu!');
      return redirect()->back();
    }

      public function unmakeMod(Request $request){
          $id = $request->input('id');
          $user = User::find($id);

          $user->role = 3;
        $user->save();

          // redirect
          session()->flash('message', 'Opettajan oikeudet poistettu!');
          return redirect()->back();
      }


}
