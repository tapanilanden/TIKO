@extends('layouts.master')

@section('content')

  <div class="col-sm-8">

    <h1>Luo uusi tehtävä</h1>

    <hr />

    <form method="POST" action={{ url('/tasks') }}>

      {{ csrf_field() }}

      <div class="form-group">
        <label for="body">Tehtävän kuvaus:</label>
        <textarea id="description" name="description" class="form-control" rows="8" required></textarea>
      </div>

      <div class="form-group">
        <label for="body">Mallivastaus:</label>
        <textarea id="model_answer" name="model_answer" class="form-control" rows="8" placeholder="Tehtävän oikea vastaus" required></textarea>
      </div>

      <div class="form-group">
        <label for="body">Tarkastuskysely:</label>
        <textarea id="model_query" name="model_query" class="form-control" rows="8" placeholder="Kysely, jolla opiskelijan vastaus voidaan tarkastaa. Select: sama kuin mallivastaus. Insert/Update: lisätty/muutettu rivi tulee löytyä tällä kyselyllä. Delete: poistettavaa riviä hakeva kysely, jota ei tulisi enää löytyä." required></textarea>
      </div>

      <div class="col-md-6">
          <input type="radio" name="type" value="1" checked>SELECT<br>
          <input type="radio" name="type" value="2">INSERT<br>
          <input type="radio" name="type" value="3">UPDATE<br>
          <input type="radio" name="type" value="4">DELETE
      </div>

      <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block">Tallenna tehtävä</button>
      </div>
    </form>


    @include ('layouts.errors')


  </div>

@endsection
