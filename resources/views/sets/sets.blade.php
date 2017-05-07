@if ($set->answers->last()->task_id == $set->tasklist->tasks->last()->id)

<div class="row well-sm"">
    <div class="col-md-8">

      

        <h6>
          <a href={{ url('/users/'.$set->user_id) }} >
            
            <strong>{{ $set->user->name }}</strong> 
            
          </a> |

          <a href={{ url('/sets/'.$set->id).'/details' }}>      

            {{ $set->id }} | {{ $set->user->name }} | {{ $set->answers->where('iscorrect', '=', 1)->count() }} / {{ $set->tasklist->tasks->count() }} tehtävää oikein.

          </a>


        </h6>

        <hr />

        
    </div>


</div>
@endif