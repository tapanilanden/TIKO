@extends('layouts.master')

    @section('content')


    <div class="container">
            <div class="row">
                <div class="col-md-8">
                </div>
                <div class="col-md-4">
                    <form method="get" action="/tasks/create">
                        <button class="btn btn-success btn-block" type="submit">Luo uusi tehtävä</button>
                    </form>
                </div>
            </div>

            <hr />


            @foreach($tasks as $task)
                
                    @include('tasks.tasks')
                <hr />

            @endforeach
            
        </div>

@stop