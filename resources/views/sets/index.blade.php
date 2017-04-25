@extends('layouts.master')

    @section('content')

    @foreach($sets as $set)
        <h3>{{ $set->id }} </h3>
        <p>{{ $set->user_id }}</p>
    
    @endforeach

@stop