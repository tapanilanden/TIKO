@extends('layouts.master')

    @section('content')
    <?php $counter = 0 ?>
    @foreach($set->tasklist->tasks as $task)
        <?php $counter = $counter + 1 ?>
        @if ($counter == $taskNumber)
        	<h2>{{$taskNumber}}. {{$task->description}}</h2><br>
        	<form method="post" action="{{ route('answers.store') }}">
        		{{csrf_field()}}
        		<input name="task_id" type="hidden" value="{{ $task->id }}">
        		<input name="set_id" type="hidden" value="{{ $set->id }}">
        		<input name="taskNumber" type="hidden" value="{{ $taskNumber }}">
        		<input name="taskCount" type="hidden" value="{{ $set->tasklist->tasks->count() }}">
        		<label for="answer">Vastaus tähän:</label>
        		<textarea class="form-control" id="answer" name="answer" required></textarea>
        		<button type="submit" class="btn btn-primary btn-block">Lukitse vastaus</button>
        	</form>
        	
        @endif
        
    @endforeach

@stop