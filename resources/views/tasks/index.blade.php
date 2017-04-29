@extends('layouts.master')

    @section('content')

    <form method="get" action="/tasks/create">
    	<button class="btn btn-success" type="submit">Luo uusi tehtävä</button>
    </form>
    @foreach($tasks as $task)
        <h3>{{ $task->id }} </h3>
        <p>{{ $task->body }}</p>
    
    @endforeach

@stop