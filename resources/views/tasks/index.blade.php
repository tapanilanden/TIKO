@extends('layouts.master')

    @section('content')

    @if (session('status'))
    	<div class="alert alert-success">
        	{{ session('status') }}
    	</div>
	@endif

    <form method="get" action="/tasks/create">
    	<button class="btn btn-success" type="submit">Luo uusi tehtävä</button>
    </form>


    @foreach($tasks as $task)
        <h3>{{ $task->id }} </h3>
        <p>{{ $task->description }}</p>
    
    @endforeach

@stop