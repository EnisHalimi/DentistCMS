@extends('layouts.app')
@section('title','Login')
@section('login','active')
@section('content')
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6  d-flex justify-content-center">
              <img src="{{App\User::getLogo()}}" class="img-fluid text-center" /></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Mirësevini në {{App\User::getAppName()}}</h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                    <div class="form-group">
                      <input type="email" name="email" value="{{ old('email') }}" required autofocus class="form-control form-control-user" id="email" aria-describedby="emailHelp" placeholder="Email">
                      @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                      @endif
                    </div>
                    <div class="form-group">
                      <input type="password" id="password" name="password" required class="form-control form-control-user" placeholder="Password">
                      @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox"  name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Mbaj në mend</label>
                      </div>
                    </div>
                    <button button type="submit"  class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                  
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

@endsection
