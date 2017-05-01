@extends('layouts.master')

	@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p>Tehtävälista luoja ja pvm: {{$tasklist->user->name}} {{$tasklist->created_at}}</p><hr>
                <p>Tehtävälistan kuvaus: {{$tasklist->body }} </p><br>
            </div>
            
            <div class="col-md-4">
                <form action="{{ route('tasklists.edit', $tasklist->id) }}">
                    <button type="submit" class="btn btn-primary btn-block">MUOKKAA</button>
                </form>
                <br>
                <form action="{{ route('tasklists.destroy', $tasklist->id) }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" class="btn btn-danger btn-block">POISTA</button>
                </form>
            </div>
        </div>
    </div>
    
	@stop