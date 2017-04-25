<!DOCTYPE html>
<html>
<?php
  use Carbon\Carbon;
?>

  <head>
    <title>WO - Harjoitustyö </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

  </head>

  <body>

    @include ('layouts.nav')



    <div class="container">

        <div class="row">

        Seliseli!

        @yield ('content')

      </div>
    </div>



    @include ('layouts.footer')

  </body>

</html>