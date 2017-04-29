@extends('layouts.master')

	@section('content')

	<p>Tehtävän luoja: {{$task->user->name}}</p><hr>
	<form action="{{ route('tasks.edit', $task->id) }}">
	    <button type="submit" class="btn btn-primary btn-block">MUOKKAA</button>
	</form>
    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
	    <button type="submit" class="btn btn-danger btn-block">POISTA</button>
	</form>

	@stop