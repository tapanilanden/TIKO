<div class="row well-sm"">
    <div class="col-md-8">
        <h6>
          <a href={{ url('/users/'.$tasklist->user_id) }} >
            
            <strong>{{ $tasklist->user->name }}</strong> 
            
          </a> |

          <a href={{ url('/tasklists/'.$tasklist->id) }} >
            
            {{ substr($tasklist->body, 0, 100) }}{{ strlen($tasklist->body) > 100 ? "...": ""}}
          @if($tasklist->tasks->count())
          ({{ $tasklist->tasks->count() }} tehtävää)
          @else
          (Ei yhtään tehtävää valittuna - lista ei käytössä)
          @endif
            
          </a>


        </h6>
    </div>
    
    <div class="col-md-2">  
          <form action="{{ route('tasklists.edit', $tasklist->id) }}">
                <button type="submit" class="btn btn-primary btn-block">MUOKKAA</button>
            </form>
    </div>
    <hr>      
    

</div>