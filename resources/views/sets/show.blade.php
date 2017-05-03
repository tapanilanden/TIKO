@extends('layouts.master')

    @section('content')
    <?php $counter = 0 ?>
    @foreach($set->tasklist->tasks as $task)
        <?php $counter = $counter + 1 ?>
        @if ($counter == $taskNumber)
        	<h2>{{$taskNumber}}. {{$task->description}}</h2><br>
        	<form method="post" action="/sets/{{$set->id}}/{{$counter}}">
        		{{csrf_field()}}
        		<label for="answer">Vastaus tähän:</label>
        		<textarea id="answer" name="answer" required></textarea>
        		<button type="submit" class="btn btn-primary btn-block">Lukitse vastaus</button>
        	</form>
        @endif
    
    @endforeach

@stop