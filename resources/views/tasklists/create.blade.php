@extends('layouts.master')

@section('content')

  <div class="col-sm-8">

    <h1>Luo uusi tehtävälista</h1>

    <hr>

    <form method="POST" action={{ url('/tasklists') }}>

      {{ csrf_field() }}

      <div class="form-group">
        <label for="body">Tehtävälistan kuvaus:</label>
        <textarea id="body" name="body" class="form-control" rows="8" required></textarea>
      </div>

      <h3> Valitse listan tehtävät:
      </h3>


      @foreach($tasks as $task)
        <div>
          {{ substr($task->description, 0, 100) }}{{ strlen($task->description) > 100 ? "...": "" }}
          <input type='checkbox' name={{$task->id}} id={{$task->id}}>
        </div>  
        <hr>
    
      @endforeach


      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Tallenna tehtävälista</button>
      </div>
    </form>


   


  </div>

@endsection