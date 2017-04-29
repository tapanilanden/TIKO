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

    <hr />


    @foreach($tasks as $task)
    
        @include('tasks.tasks')
        <hr />
    
    @endforeach

@stop