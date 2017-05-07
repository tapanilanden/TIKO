@extends('layouts.master')

	@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <p>Tehtäväsarjan suorittaja: {{$set->user->name}}</p>
                <p>Tehtävälista: {{ $set->tasklist->body }}</p>
                <hr />
                <p>Vastaukset:</p>
                @foreach($set->answers as $answer)
                    <p>{{ $loop->iteration . ". " . substr($answer->body, 0, 100) }}{{ strlen($answer->body) > 100 ? "...": ""}}
                    @if ($answer->iscorrect == 1)

                    (Oikein)

                    @else

                    (Väärin)

                    @endif

                    </p>
                @endforeach
            </div>
        </div>
    </div>
    
	@stop