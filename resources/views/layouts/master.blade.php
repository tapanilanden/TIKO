<!DOCTYPE html>
<html>
<?php
  use Carbon\Carbon;
?>

  <head>
    <title>TiKO - Harjoitustyö </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

  </head>

  <body>


      


    


    <div class="container">

        <div class="row">



        @include ('layouts.nav')

        @if ($flash = session('message'))
          <div id="flash-message" class="alert alert-success" role="alert">
              {{ $flash }}
          </div>
          @elseif ($flash = session('error'))
              <div id="flash-message" class="alert alert-danger" role="alert">
                  {{ $flash }}
              </div>
        @endif

        @yield ('content')

        @include ('layouts.footer')



      </div>
    </div>



    





    

  </body>

</html>