@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h1>Tervetuloa Tiko-harkkatyö sovellukseen!</h1>
  @if (Auth::guest())
  	<p>Aloita kirjautumalla sisään tai rekisteröimällä.</p>
  @else
  	<label>Valitse tehtävälista:<label><br>
  	@foreach($tasklists as $tasklist)
  		<div class="col-md-8">
        <h6>
            
            <strong>{{ $tasklist->user->name }}</strong> |
            
            {{ substr($tasklist->body, 0, 100) }}{{ strlen($tasklist->body) > 100 ? "...": ""}}
            
            <form method="post" action="{{ route('sets.store') }}">
            	{{ csrf_field() }}
            	<input type="hidden" name="tl_id" value="{{ $tasklist->id }}">
            	<button class="btn btn-success btn-block" type="submit">Aloita</button>
            </form>
        </h6>
    </div>
    @endforeach
  @endif
</div>
@endsection
