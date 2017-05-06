@extends('layouts.master')

@section('content')

  <div class="col-sm-8 blog-main">

    <h1>Muokkaa käyttäjän tietoja</h1>

    <hr />

    <form method="POST" action={{ url('users/'.$user->id) }}>

      <input type="hidden" name="_method" value="PUT">
      
      {{ csrf_field() }}


      <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <label for="name" class="col-md-4 control-label">Nimi</label>

          <div class="col-md-6">
              <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required autofocus>

              @if ($errors->has('name'))
                  <span class="help-block">
                      <strong>{{ $errors->first('name') }}</strong>
                  </span>
              @endif
          </div>
      </div>


      <div class="form-group{{ $errors->has('ppt') ? ' has-error' : '' }}">
          <label for="ppt" class="col-md-4 control-label">Peruspalvelutunnus</label>

          <div class="col-md-6">
              <input id="ppt" type="text" class="form-control" name="ppt" value="{{ $user->ppt }}" required>

              @if ($errors->has('ppt'))
                  <span class="help-block">
                      <strong>{{ $errors->first('ppt') }}</strong>
                  </span>
              @endif
          </div>
      </div

      <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <label for="email" class="col-md-4 control-label">Sähköpostiosoite</label>

          <div class="col-md-6">
              <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

              @if ($errors->has('email'))
                  <span class="help-block">
                      <strong>{{ $errors->first('email') }}</strong>
                  </span>
              @endif
          </div>
      </div>


      <div class="form-group">
          <div class="col-md-6">
              <input type="radio" name="major" value="1" checked>Tietojenkäsittelytiede<br>
              <input type="radio" name="major" value="2">Matematiikka ja tilastotiede<br>
              <input type="radio" name="major" value="3">Informaatiotutkimus ja interaktiivinen media<br>
              <input type="radio" name="major" value="4">Jokin muu
          </div>
      </div>

      <div class="form-group">
      <button type="submit" class="btn btn-primary btn-block">Tallenna muutokset</button>
      </div>
    </form>





  </div>

@endsection