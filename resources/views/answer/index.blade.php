@extends('layouts.master')

@section('content')

    @foreach($answers as $answer)
        <h3>{{ $answer->id }} </h3>
        <p>{{ $answer->body }}</p>
    
    @endforeach

@stop