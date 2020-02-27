@extends('layouts.app')
@section('title','Shto Perdorues')
@section('user','active')
@section('content')

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 m-auto d-flex justify-content-center ">
          <img src="{{App\User::getLogo()}}" class="img-fluid" />
          </div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Shto Përdorues!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('user.store') }}">
                        {{ csrf_field() }}
                <div class="form-group ">
                  <input id="name" name="Emri_dhe_Mbiemri" value="{{ old('Emri_dhe_Mbiemri') }}" required autofocus type="text" class="form-control form-control-user @error('Emri_dhe_Mbiemri') is-invalid @enderror"  placeholder="Emri dhe Mbiemri">
                  @if ($errors->has('Emri_dhe_Mbiemri'))
                                    <span class="help-block">
                                        <strong class="text-danger"><small>{{ $errors->first('Emri_dhe_Mbiemri') }}</small></strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                  <input  id="email" name="email" value="{{ old('email') }}" required type="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email Address">
                  @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger"><small>>{{ $errors->first('email') }}</small></strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group">
                  <input  id="position" name="Pozita" value="{{ old('Pozita') }}" required type="text" class="form-control form-control-user @error('Pozita') is-invalid @enderror" placeholder="Pozita">
                  @if ($errors->has('Pozita'))
                                    <span class="help-block">
                                        <strong class="text-danger"><small>{{ $errors->first('Pozita') }}</small></strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input id="password" name="password" required type="password" class="form-control form-control-user @error('password') is-invalid @enderror"  placeholder="Password">
                    
                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger"><small>{{ $errors->first('password') }}</small></strong>
                                    </span>
                                @endif
                  </div>
                  <div class="col-sm-6">
                    <input id="password-confirm" name="password_confirmation" required type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Përsërit Password">
                  </div>
                </div>
                <div class="form-group">
                  <a class="btn btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                    <button type="submit"  class="btn btn-circle btn-primary float-right"><i class="fa fa-save"></i></button>
                  </div>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection