@extends('layouts.master')

@section('content')

  <div class="col-sm-8 blog-main">

    <h1>Muokkaa tehtävälistaa</h1>

    <hr />

    <form method="POST" action={{ url('tasklists/'.$tasklist->id) }}>

      <input type="hidden" name="_method" value="PUT">
      
      {{ csrf_field() }}

       <div class="form-group">
        <label for="body">Tehtävälistan kuvaus:</label>
        <textarea id="body" name="body" class="form-control" rows="8" 
                  required >{{ $tasklist->body }}</textarea>
      </div>

      

      <div class="col-md-6">
        <label>Tehtävälistan tehtävät:</label>
          @foreach($tasklist->tasks as $task)
            <h6>
              <strong>{{ $task->user->name }}</strong> |
                {{ substr($task->description, 0, 100) }}{{ strlen($task->description) > 100 ? "...": ""}}
            </h6> 
              <label>Poista tehtävälistasta</label>
              <input type='checkbox' name={{$task->id}} id={{$task->id}}>
            <hr>
          @endforeach
      </div>
      
      <div class="col-md-6">
        <label>Kaikki tehtävät:</label>
          @foreach($tasks as $task)
            <h6>
              <strong>{{ $task->user->name }}</strong> |
                {{ substr($task->description, 0, 100) }}{{ strlen($task->description) > 100 ? "...": ""}}
            </h6> 
              <label>Lisää tehtävälistaan</label>
              <input type='checkbox' name={{$task->id}} id={{$task->id}}>
            <hr>
          @endforeach
      </div>
   

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">Tallenna muutokset</button>
      </div>
    </form>


    @include ('layouts.errors')


  </div>

@endsection