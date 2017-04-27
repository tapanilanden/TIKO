<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">TiKO Harkkatyö</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
        <li><a href="#">Link</a></li>

         @if (Auth::check() && Auth::user()->role < 2)
          <li><a class="nav-link" href={{ url('/users') }}>Käyttäjien hallinta</a></li>
        @endif

        @if (Auth::check() && Auth::user()->role < 3)
          <li><a class="nav-link" href={{ url('/tasks') }}>Tehtävien hallinta</a></li>
        @endif



      </ul>
      <ul class="nav navbar-nav navbar-right">
        @if (! Auth::check())
          <li><a class="nav-link ml-auto" href={{ url('/login') }}>Kirjaudu sisään</a></li>
          @endif

          @if (Auth::check())
          <li><a href="{{ route('logout') }}"
            onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">

          {{ Auth::user()->name }} - kirjaudu ulos</a></li>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        @endif
      </ul>
    </div>
  </div>
</nav>


<div class="jumbotron">
  <h1>Jumbotron</h1>
  <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
  <p><a class="btn btn-primary btn-lg">Learn more</a></p>
</div>







  