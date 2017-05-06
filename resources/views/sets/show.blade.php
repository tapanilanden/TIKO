@extends('layouts.master')

    @section('content')
    <?php $counter = 0 ?>
    
    @foreach($set->tasklist->tasks as $task)
        <?php $counter = $counter + 1 ?>
        @if ($counter == $taskNumber)
            <div class="row">
                <div class="col-md-4">
                     <table class="table" name="opiskelijat">
                        <caption>opiskelijat</caption>
                          <tr>
                            <th>nro</th>
                            <th>nimi</th>
                            <th>p_aine</th>
                          </tr>
                          @foreach($opiskelijat as $opiskelija)
                          <tr>
                            <td>{{ $opiskelija->nro }}</td>
                            <td>{{ $opiskelija->nimi }}</td>
                            <td>{{ $opiskelija->p_aine }}</td>
                          </tr>
                          @endforeach
                    </table>
                </div>
                <div class="col-md-4">
                     <table class="table" name="kurssit">
                        <caption>kurssit</caption>
                          <tr>
                            <th>id</th>
                            <th>nimi</th>
                            <th>opettaja</th>
                          </tr>
                          @foreach($kurssit as $kurssi)
                          <tr>
                            <td>{{ $kurssi->id }}</td>
                            <td>{{ $kurssi->nimi }}</td>
                            <td>{{ $kurssi->opettaja }}</td>
                          </tr>
                          @endforeach
                    </table>
                </div>
                <div class="col-md-4">
                     <table class="table" name="suoritukset">
                        <caption>suoritukset</caption>
                          <tr>
                            <th>k_id</th>
                            <th>op_nro</th>
                            <th>arvosana</th>
                          </tr>
                          @foreach($suoritukset as $suoritus)
                          <tr>
                            <td>{{ $suoritus->k_id }}</td>
                            <td>{{ $suoritus->op_nro }}</td>
                            <td>{{ $suoritus->arvosana }}</td>
                          </tr>
                          @endforeach
                    </table>
                </div> 
            </div>
            
        	<h2>{{$taskNumber}}. {{$task->description}}</h2><br>
        	<form method="post" action="{{ route('answers.store') }}">
        		{{csrf_field()}}
        		
    
        	    
        		<input name="task_id" type="hidden" value="{{ $task->id }}">
        		<input name="set_id" type="hidden" value="{{ $set->id }}">
        		<input name="taskNumber" type="hidden" value="{{ $taskNumber }}">
        		<input name="taskCount" type="hidden" value="{{ $set->tasklist->tasks->count() }}">
        		<label for="answer">Vastaus tähän:</label>
        		<textarea class="form-control" id="answer" name="answer" required></textarea>
        		<button type="submit" class="btn btn-primary btn-block">Lukitse vastaus</button>
        	</form>
        	
        	
        	
        @endif
        
    @endforeach

    

@stop

    <script type="text/javascript">
        

        window.onload = setTimeout(function() {
                            alert("Aika loppui! Session tiedot poistetaan.");
                            window.location="{{ route('sets.timeout', ['id' => $set->id]) }}";
                        }, 600000);
                        
        
        
    </script>