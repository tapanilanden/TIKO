@extends('layouts.master')

    @section('content')

    <div class="container">
            <div class="row">
                <div class="col-md-8">
                </div>

            </div>


            @foreach($sets as $set)
                
                    @include('sets.sets')

            @endforeach
            
        </div>

@stop