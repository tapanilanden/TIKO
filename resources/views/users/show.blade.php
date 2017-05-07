@extends('layouts.master')

	@section('content')

	<h1>{{$user->name}}

  @if($user->role == 1)
   (Admin)
  @endif

  @if($user->role == 2)
    (Opettaja)
  @endif



  </h1><hr>

  @if ((Auth::user()->role == 1) && ($user->role != 1))

            @if ($user->role != 2)

             <form method="POST" action={{ url('/users/'.$user->id.'/makeMod') }}>


                  {{ csrf_field() }}

                  <input type="hidden" name="id" value="{{ $user->id }}">

                <button type="submit" class="btn btn-outline-success btn-sm">Anna opettajan oikeudet</button>
              </form>
            @endif

            @if ($user->role == 2)

              <form method="POST" action={{ url('/users/'.$user->id.'/unmakeMod') }}>
                  {{ csrf_field() }}

                  <input type="hidden" name="id" value="{{ $user->id }}">


                <button type="submit" class="btn btn-outline-warning btn-sm">Poista opettajan oikeudet</button>
              </form>
            @endif

          </div>
          <hr />
    @endif



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

	@stop
