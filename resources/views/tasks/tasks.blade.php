<div>

	<h6>

		<a href={{ url('/users/'.$task->user->id) }}>
	    {{ $task->user->name }}
	  	</a> |



	  	<a href={{ url('/tasks/'.$task->id) }}>
	    	{{ $task->description }}
	  	</a>

 	</h6>

</div>