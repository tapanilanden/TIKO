@extends('layouts.master')

	@section('content')

	<p>Tehtävän luoja ja pvm: {{$task->user->name}} {{$task->created_at}}</p><hr>
	<p>Tehtävän kuvaus: {{$task->description }} </p><br>
	<p>Tehtävän tyyppi: @if ($task->type == 1) Select @elseif($task->type == 2) Insert @elseif($task->type == 3) Update @else Delete @endif</p><br>
	<p>Tehtävän mallivastaus: {{$task->model_query}}</p><br>


	@stop