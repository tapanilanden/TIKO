<div class="row well-sm"">
    <div class="col-md-8">
        <h6>
          <a href={{ url('/users/'.$tasklist->user_id) }} >
            
            <strong>{{ $tasklist->user->name }}</strong> 
            
          </a> |

          <a href={{ url('/tasklists/'.$tasklist->id) }} >
            
            {{ substr($tasklist->body, 0, 100) }}{{ strlen($tasklist->body) > 100 ? "...": ""}}
            
          </a>


        </h6>
    </div>
    
    <div class="col-md-2">  
          <form action="{{ route('tasklists.edit', $tasklist->id) }}">
                <button type="submit" class="btn btn-primary btn-block">MUOKKAA</button>
            </form>
    </div>
    <div class="col-md-2">  
            <form action="{{ route('tasklists.destroy', $tasklist->id) }}" method="POST">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger btn-block">POISTA</button>
            </form>
    </div>
    <hr>      
    

</div>