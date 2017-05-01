@extends('layouts.master')

    @section('content')

    <div class="container">
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <form method="get" action="/tasklists/create">
                        <button class="btn btn-success btn-block" type="submit">Luo uusi tehtävälista</button>
                    </form>
                </div>
            </div>

            <hr />


            @foreach($tasklists as $tasklist)
                
                    @include('tasklists.tasklists')
                <hr />

            @endforeach
            
        </div>

@stop