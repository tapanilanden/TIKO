@extends('layouts.master')

    @section('content')

    {{ Form::open(['method' => 'get', 'action' => ['TaskController@create']]) }}
		{{ Form::submit('Luo uusi tehtävä', ['class' => 'btn btn-default']) }}
	{{ Form::close() }}

    @foreach($tasks as $task)
        <h3>{{ $task->id }} </h3>
        <p>{{ $task->body }}</p>
    
    @endforeach

@stop