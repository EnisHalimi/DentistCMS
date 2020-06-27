@extends('layouts.app')
@section('title','Shto Pacient')
@section('pacient','active')
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
                    <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Shto Pacient!</h1>
                </div>
            <form class="user" method="POST" action="{{ route('pacient.store') }}">
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                        <label class="text-xs"  for="first_name">Emri</label>
                    <input id="first_name" name="Emri" required type="text" value="{{old('Emri')}}" class="form-control form-control-user  @error('Emri') is-invalid @enderror"   placeholder="Emri">

                                  @if ($errors->has('Emri'))
                                                  <span class="help-block">
                                                      <strong class="text-danger"><small>{{ $errors->first('Emri') }}</small></strong>
                                                  </span>
                                              @endif
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                    <label class="text-xs"  for="fathers_name">Emri i Prindit</label>
                                        <input id="fathers_name" name="Emri_Prindit"  value="{{old('Emri_Prindit')}}"  required type="text" class="form-control form-control-user @error('Emri_Prindit') is-invalid @enderror"  placeholder="Emri Prindit">
                                        @if ($errors->has('Emri_Prindit'))
                                                  <span class="help-block">
                                                      <strong class="text-danger"><small>{{ $errors->first('Emri_Prindit') }}</small></strong>
                                                  </span>
                                              @endif
                                      </div>
                                <div class="col-sm-4">
                                    <label class="text-xs"  for="last_name">Mbiemri</label>
                                  <input id="last_name" name="Mbiemri" required type="text"  value="{{old('Mbiemri')}}" class="form-control form-control-user @error('Mbiemri') is-invalid @enderror" placeholder="Mbiemri">
                                  @if ($errors->has('Mbiemri'))
                                                  <span class="help-block">
                                                      <strong class="text-danger"><small>{{ $errors->first('Mbiemri') }}</small></strong>
                                                  </span>
                                              @endif
                                </div>
                 </div>
                 <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label class="text-xs"  for="personal_number">Numri Personal</label>
                        <input id="personal_number" name="Numri_Personal" value="{{old('Numri_Personal')}}" required type="text" class="form-control form-control-user @error('Numri_Personal') is-invalid @enderror"  placeholder="Numri Personal">

                          @if ($errors->has('Numri_Personal'))
                                          <span class="help-block">
                                              <strong class="text-danger"><small>{{ $errors->first('Numri_Personal') }}</small></strong>
                                          </span>
                                      @endif
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                            <label class="text-xs"  for="date_of_birth">Data e lindjes</label>
                        <input id="date_of_birth" name="Data_e_lindjes" required value="{{old('Data_e_lindjes')}}"  type="date"  class="form-control form-control-user @error('Data_e_lindjes') is-invalid @enderror">
                                @if ($errors->has('Data_e_lindjes'))
                                          <span class="help-block">
                                              <strong class="text-danger"><small>{{ $errors->first('Data_e_lindjes') }}</small></strong>
                                          </span>
                                      @endif
                              </div>
                        <div class="col-sm-4">
                            <label class="text-xs"  for="gender">Gjinia</label>
                                <div class="custom-control custom-checkbox small">
                                        <input type="radio"  name="gender" value="M" class="custom-control-input @error('gender') is-invalid @enderror" checked id="gender1">
                                        <label class="custom-control-label" for="gender1">Mashkull</label>
                                </div>
                                <div class="custom-control custom-checkbox small">
                                        <input type="radio"  name="gender" value="F"  class="custom-control-input @error('gender') is-invalid @enderror" id="gender2">
                                        <label class="custom-control-label" for="gender2">Femër</label>
                                </div>
                          @if ($errors->has('gender'))
                                          <span class="help-block">
                                            <strong class="text-danger"><small>{{ $errors->first('gender') }}</small></strong>
                                          </span>
                                      @endif
                        </div>
                </div>
                <div class="form-group">
                    <label class="text-xs"  for="address">Adresa</label>
                <input  id="address" name="Adresa"  required type="text" value="{{old('Adresa')}}" class="form-control form-control-user @error('Adresa') is-invalid @enderror" placeholder="Adresa">
                        @if ($errors->has('Adresa'))
                                          <span class="help-block">
                                              <strong class="text-danger"><small>{{ $errors->first('Adresa') }}</small></strong>
                                          </span>
                                      @endif
                      </div>
                <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label class="text-xs"  for="residence">Vendbanimi</label>
                          <input id="residence" name="Vendbanimi"  value="{{old('Vendbanimi')}}" required type="text" class="form-control form-control-user @error('Vendbanimi') is-invalid @enderror"  placeholder="Vendbanimi">

                          @if ($errors->has('Vendbanimi'))
                                          <span class="help-block">
                                            <strong class="text-danger"><small>{{ $errors->first('Vendbanimi') }}</small></strong>
                                          </span>
                                      @endif
                        </div>
                        <div class="col-sm-6">
                            <label class="text-xs"  for="city">Qyteti</label>
                        <input id="city" name="Qyteti" value="{{old('Qyteti')}}" required type="text" class="form-control form-control-user @error('Qyteti') is-invalid @enderror" placeholder="Qyteti">
                                @if ($errors->has('Qyteti'))
                                                <span class="help-block">
                                                    <strong class="text-danger"><small>{{ $errors->first('Qyteti') }}</small></strong>
                                                </span>
                                            @endif
                              </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <label class="text-xs"  for="phone">Telefoni</label>
                    <input id="phone" name="Telefoni" value="{{old('Telefoni')}}" required type="text" class="form-control form-control-user @error('Telefoni') is-invalid @enderror"  placeholder="Numri i telefonit">
                        @if ($errors->has('Telefoni'))
                            <span class="help-block">
                                <strong class="text-danger"><small>{{ $errors->first('Telefoni') }}</small></strong>
                            </span>
                        @endif
                    </div>
                    <div class="col-sm-6">
                        <label class="text-xs"  for="email">E-mail</label>
                        <input id="email" name="email"  type="email" class="form-control form-control-user" placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
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
