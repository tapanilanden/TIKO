@extends('layouts.master')

    @section('content')



    <form method="get" action="/tasks/create">
    	<button class="btn btn-success" type="submit">Luo uusi tehtävä</button>
    </form>

    <hr />


    @foreach($tasks as $task)

        @include('tasks.tasks')
        <hr />
    
    @endforeach

@stop