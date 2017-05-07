@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h1>Tervetuloa Tiko-harkkatyö sovellukseen!</h1>
  @if (Auth::guest())
  	<p>Aloita kirjautumalla sisään tai rekisteröimällä.</p>
  @else
  	<label>Valitse suoritettava tehtävälista:<label><br>
  	@foreach($tasklists as $tasklist)
  		<div class="col-md-8">

        @if ($tasklist->tasks->count())
        <h6>
            
            <strong>{{ substr($tasklist->body, 0, 100) }}{{ strlen($tasklist->body) > 100 ? "...": ""}}</strong> |
            @if ($tasklist->tasks->count() == 1)
            
            <strong>{{ $tasklist->tasks->count()}} tehtävä</strong>  

            @else

            <strong>{{ $tasklist->tasks->count()}} tehtävää</strong> 


            @endif
            
            
            
            <form method="post" action="{{ route('sets.store') }}">
            	{{ csrf_field() }}
            	<input type="hidden" name="tl_id" value="{{ $tasklist->id }}">
            	<button type="submit" class="btn btn-primary btn-block">ALOITA</button>
            </form>
        </h6>
        @endif
    </div>
    @endforeach
  @endif
</div>
@endsection
