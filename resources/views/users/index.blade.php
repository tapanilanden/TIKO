@extends('layouts.master')


    @section('content')

    <div class="col-sm-8">

    @foreach($users as $user)
        @include('users.users')
        <hr />
    
    @endforeach

    </div>

@stop