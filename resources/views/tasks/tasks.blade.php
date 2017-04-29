
<div class="row well-sm"">
    <div class="col-md-8">
        <h6>
          <a href={{ url('/tasks/'.$task->id) }} >
            
            <strong>{{ $task->user->name }}</strong> : {{ substr($task->description, 0, 100) }}{{ strlen($task->description) > 100 ? "...": ""}}
            
          </a>
        </h6>
    </div>
    
    <div class="col-md-2">  
          <form action="{{ route('tasks.edit', $task->id) }}">
                <button type="submit" class="btn btn-primary btn-block">MUOKKAA</button>
            </form>
    </div>
    <div class="col-md-2">  
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger btn-block">POISTA</button>
            </form>
    </div>
    <hr>      
    

</div>