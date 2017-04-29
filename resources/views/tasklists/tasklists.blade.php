<div>

	<h6>

		<a href={{ url('/users/'.$tasklist->user->id) }}>
	    {{ $task->user->name }}
	  	</a> |



	  	<a href={{ url('/tasklists/'.$tasklist->id) }}>
	    	{{ $tasklist->body }}
	  	</a>

 	</h6>

</div>