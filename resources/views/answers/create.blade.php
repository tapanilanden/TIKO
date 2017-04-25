@extends('layouts.master')

    <div class ="row">
        <div class="col-md-8 col-md-offset-2">
        
        <form class="form-horizontal" role="form" method="POST" action="{{ route('answers.store') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="answer" class="col-md-4 control-label">Answer</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="answer" required autofocus>
                    
                    
                    </div>
                </div>
                
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                        submit
                        </button>
                    </div>
                </div>
        </form>
            
        </div>
    </div>


@stop