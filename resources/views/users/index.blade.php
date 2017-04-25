@extends('layouts.master')

    @section('content')

    @foreach($users as $user)
        <h3>{{ $user->id }} </h3>
        <p>{{ $user->name }}</p>
    
    @endforeach

@stop