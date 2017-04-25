@extends('layouts.master')

    @section('content')

    @foreach($tasks as $task)
        <h3>{{ $task->id }} </h3>
        <p>{{ $task->body }}</p>
    
    @endforeach

@stop