@extends('layouts.master')

    @section('content')

    <form method="get" action="/tasklists/create">
    	<button class="btn btn-success" type="submit">Luo uusi tehtävälista</button>
    </form>

    <hr />


    @foreach($tasklists as $tasklist)
        <h3>{{ $tasklist->id }} </h3>
        <p>{{ $tasklist->body }}</p>
    
    @endforeach

@stop