@extends('layouts.master')

	@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p>Tehtävän luoja ja pvm: {{$task->user->name}} {{$task->created_at}}</p><hr>
                <p>Tehtävän kuvaus: {{$task->description }} </p><br>
                <p>Tehtävän tyyppi: @if ($task->type == 1) Select @elseif($task->type == 2) Insert @elseif($task->type == 3) Update @else Delete @endif</p><br>
                <p>Tehtävän tarkastuskysely: {{$task->model_query}}</p><br>
                <p>Tehtävän mallivastaus: {{$task->modelAnswer->body}}</p><br>
            </div>
            
            <div class="col-md-4">
                <form action="{{ route('tasks.edit', $task->id) }}">
                    <button type="submit" class="btn btn-primary btn-block">MUOKKAA</button>
                </form>
                <br>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-block">POISTA</button>
                </form>
            </div>
        </div>
    </div>
    
	@stop