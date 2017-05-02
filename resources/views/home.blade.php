@extends('layouts.master')

@section('content')
<div class="jumbotron">
  <h1>Tervetuloa Tiko-harkkatyö sovellukseen!</h1>
  @if (Auth::guest())
  	<p>Aloita kirjautumalla sisään tai rekisteröimällä.</p>
  @else
  	<label>Valitse tehtäväsarja:<label><br>
  	
  @endif
</div>
@endsection
