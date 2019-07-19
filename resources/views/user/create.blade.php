@extends('layouts.app')
@section('title','User Register')
@section('content')

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block ">
          <img src="https://www.onlinelogomaker.com/blog/wp-content/uploads/2017/09/Dental-Logo-Design.jpg" class="img-fluid" />
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Shto Përdorues!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('user.store') }}">
                        {{ csrf_field() }}
                <div class="form-group ">
                  <input id="name" name="name" value="{{ old('name') }}" required autofocus type="text" class="form-control form-control-user"  placeholder="Emri dhe Mbiemri">
                  @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                  <input  id="email" name="email" value="{{ old('email') }}" required type="email" class="form-control form-control-user" placeholder="Email Address">
                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                  <input  id="position" name="position" value="{{ old('position') }}" required type="text" class="form-control form-control-user" placeholder="Pozita">
                  @if ($errors->has('position'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('position') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input id="password" name="password" required type="password" class="form-control form-control-user"  placeholder="Password">
                    
                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                  </div>
                  <div class="col-sm-6">
                    <input id="password-confirm" name="password_confirmation" required type="password" class="form-control form-control-user" placeholder="Repeat Password">
                  </div>
                </div>
                  <button type="submit"  class="btn btn-primary btn-user btn-block">
                  Regjistro
                </button>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection