@extends('layouts.master')

	@section('content')

	<h1>{{$user->name}}</h1><hr>

	<form action="{{ route('users.edit', $user->id) }}">
	    <button type="submit" class="btn btn-primary btn-block">MUOKKAA</button>
	</form>
    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
	    <button type="submit" class="btn btn-danger btn-block">POISTA</button>
	</form>

	@stop