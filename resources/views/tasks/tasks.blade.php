
<div class="row well-sm"">
    <div class="col-md-6 col-md-offset-2">
        <h6>
          <a href={{ url('/tasks/'.$task->id) }} >
            
            {{ $task->user->name }} : {{ $task->description }}
            
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