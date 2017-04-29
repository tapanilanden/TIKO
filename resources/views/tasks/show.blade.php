@extends('layouts.master')

	@section('content')

	<p>Tehtävän kuvaus: {{$task->description }} </p><br>
	<p>Tehtävän tyyppi: @if ($task->type == 1) Select @elseif($task->type == 2) Insert @elseif($task->type == 3) Update @else Delete @endif</p><br>
	<p>Tehtävän mallivastaus: {{$task->model_query}}</p><br>
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