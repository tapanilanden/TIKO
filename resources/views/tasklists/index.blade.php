@extends('layouts.master')

    @section('content')

    @foreach($tasklists as $tasklist)
        <h3>{{ $tasklist->id }} </h3>
        <p>{{ $tasklist->body }}</p>
    
    @endforeach

@stop