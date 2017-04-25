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

    @include ('layouts.nav')

        <div class="row">

        @yield ('content')

      </div>

      @include ('layouts.footer')

    </div>



    

  </body>

</html>