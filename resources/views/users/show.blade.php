@extends('layouts.master')

	@section('content')

	<h1>{{$user->name}}</h1><hr>

  <h5>Käytäjän tiedot:</h5>

  <p><b>Sähköpostiosoite:</b> {{ $user->email }}
  </p>

  <p><b>Peruspalvelutunnus:</b> {{ $user->ppt }}
  </p>

  @if (count($user->major))

    <p><b>Pääaine:</b>

      @if ($user->major == 1)
        Tietojenkäsittelytiede
      @endif
      @if ($user->major == 2)
        Matematiikka ja tilastotiede
      @endif
      @if ($user->major == 3)
        Informaatiotutkimus ja interaktiivinen media
      @endif
      @if ($user->major == 4)
        Jokin muu
      @endif
    </p>

  @endif

  <hr />


    @if (count($user->tasks))
      <h5>Käyttäjän luomat tehtävät:</h5>
      @foreach ($user->tasks as $task)
      <a href={{ url('/tasks/'.$task->id) }}>
        {{ substr($task->description, 0, 100) }}{{ strlen($task->description) > 100 ? "...": "" }}
      </a>
        <hr />
      @endforeach
    @endif

    @if (count($user->tasklists))
      <h5>Käyttäjän luomat tehtävälistat:</h5>
      @foreach ($user->tasklists as $tasklist)
      <a href={{ url('/tasklists/'.$tasklist->id) }}>
        {{ $tasklist->body }}
      </a>
        <hr />
      @endforeach
    @endif

	<form action="{{ route('users.edit', $user->id) }}">
	    <button type="submit" class="btn btn-primary btn-block">MUOKKAA</button>
	</form>
    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="_method" value="DELETE">
	    <button type="submit" class="btn btn-danger btn-block">POISTA</button>
	</form>

	@stop

<!-- 
  $table->increments('id');
            $table->string('ppt')->unique(); // Peruspalvelutunnus
            $table->string('name');
            $table->integer('major'); // Pääaine
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role')->default(3); // Käyttöoikeusluokka, default 3 <- opiskelija
            $table->rememberToken();
            $table->timestamps(); -->