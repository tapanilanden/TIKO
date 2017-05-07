@extends('layouts.master')

	@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p>Tehtävälista luoja ja pvm: {{$tasklist->user->name}} {{$tasklist->created_at}}</p><hr>
                <p>Tehtävälistan kuvaus: {{$tasklist->body }} </p><br>
                <p>Tehtävät:</p>
                @foreach($tasklist->tasks as $task)
                    <p>{{ $loop->iteration . ". " . substr($task->description, 0, 100) }}{{ strlen($task->description) > 100 ? "...": ""}}</p>
                @endforeach
            </div>
            
            <div class="col-md-4">
                <form action="{{ route('tasklists.edit', $tasklist->id) }}">
                    <button type="submit" class="btn btn-primary btn-block">MUOKKAA</button>
                </form>
            </div>

            <?php
            $slowest = 0;
            $fastest = 900000000;
            $sum = 0;
            $index = 0;
            ?>

            @foreach ($tasklist->sets as $set)
                @if ($set->answers->last()->task_id == $set->tasklist->tasks->last()->id)
                <?php

                $timeDifference = $set->updated_at->diffInSeconds($set->created_at);

                $sum += $timeDifference;
                $index++;

                if ($timeDifference > $slowest){
                    $slowest = $timeDifference;
                }

                if ($timeDifference < $fastest){
                    $fastest = $timeDifference;
                }


                ?>
                @endif
            @endforeach

            <?php
                $slowest = gmdate('H:i:s', $slowest);
                $fastest = gmdate('H:i:s', $fastest);
                $average = $sum / $index;
                $average = gmdate('H:i:s', $average);
            ?>


            <div class="col-md-8"> 
            <h4>Info</h4>
            <p>
            Tehtävälistan nopein suoritusaika (H:M:S): {{ $fastest }}
            </p>
            <p>
            Tehtävälistan hitain suoritusaika (H:M:S): {{ $slowest }}
            </p>
            <p>
            Tehtävälistan keskimääräinen suoritusaika (H:M:S): {{ $average }}
            </p>
            </div>
        </div>
    </div>

    
    
	@stop