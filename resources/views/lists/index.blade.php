@extends('layouts.master')

    @section('content')

    @foreach($lists as $list)
        <h3>{{ $list->id }} </h3>
        <p>{{ $list->body }}</p>
    
    @endforeach

@stop