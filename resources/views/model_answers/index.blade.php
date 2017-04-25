@extends('layouts.master')

    @section('content')

    @foreach($modelanswers as $modelanswer)
        <h3>{{ $modelanswer->id }} </h3>
        <p>{{ $modelanswer->body }}</p>
    
    @endforeach

@stop