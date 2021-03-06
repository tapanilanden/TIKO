<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

use App\Tasklist;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasklists = Tasklist::all();
        return view('home')->withTasklists($tasklists);
    }
}
