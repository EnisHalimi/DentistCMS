@extends('layouts.app')
@section('title','Ndrysho Pacient')
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
                    <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Ndrysho Pacientin {{$pacient->first_name}} {{$pacient->last_name}}</h1>
                </div>
            <form class="user" method="POST" action="{{ route('pacient.update',$pacient->id) }}">
                    {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                                  <input id="first_name" name="Emri" value="{{$pacient->first_name}}" required type="text" class="form-control form-control-user @error('Emri') is-invalid @enderror"  placeholder="Emri">
                                  
                                  @if ($errors->has('Emri'))
                                                  <span class="help-block">
                                                      <strong class="text-danger"><small>{{ $errors->first('Emri') }}</small></strong>
                                                  </span>
                                              @endif
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input id="fathers_name" name="Emri_Prindit" value="{{$pacient->fathers_name}}" required type="text" class="form-control form-control-user @error('Emri_Prindit') is-invalid @enderror" placeholder="Emri Prindit">
                                        @if ($errors->has('Emri_Prindit'))
                                        <span class="help-block">
                                            <strong class="text-danger"><small>{{ $errors->first('Emri_Prindit') }}</small></strong>
                                        </span>
                                    @endif
                                      </div>
                                <div class="col-sm-4">
                                  <input id="last_name" name="Mbiemri" required type="text" value="{{$pacient->last_name}}" class="form-control form-control-user @error('Mbiemri') is-invalid @enderror" placeholder="Mbiemri">
                                  @if ($errors->has('Mbiemri'))
                                  <span class="help-block">
                                      <strong class="text-danger"><small>{{ $errors->first('Mbiemri') }}</small></strong>
                                  </span>
                              @endif
                                </div>
                 </div>
                 <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                          <input id="personal_number" name="Numri_Personal" value="{{$pacient->personal_number}}" required type="text" class="form-control form-control-user @error('Numri_Personal') is-invalid @enderror"  placeholder="Numri Personal">
                          @if ($errors->has('Numri_Personal'))
                          <span class="help-block">
                              <strong class="text-danger"><small>{{ $errors->first('Numri_Personal') }}</small></strong>
                          </span>
                      @endif
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                                <input id="date_of_birth" name="Data_e_lindjes" required  type="date" value="{{$pacient->birth_day}}" class="form-control form-control-user @error('Data_e_lindjes') is-invalid @enderror">
                                @if ($errors->has('Data_e_lindjes'))
                                <span class="help-block">
                                    <strong class="text-danger"><small>{{ $errors->first('Data_e_lindjes') }}</small></strong>
                                </span>
                            @endif
                              </div>
                        <div class="col-sm-4">
                                <div class="custom-control custom-checkbox small">
                                        <input type="radio"  name="gender" value="M" @if($pacient->gender == 'M') checked @else @endif  class="custom-control-input @error('gender') is-invalid @enderror"  id="gender1">
                                        <label class="custom-control-label" for="gender1">Mashkull</label>
                                </div>
                                <div class="custom-control custom-checkbox small">
                                        <input type="radio"  name="gender" value="F" @if($pacient->gender == 'F') checked @else @endif   class="custom-control-input @error('gender') is-invalid @enderror" id="gender2">
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
                        <input  id="address" name="Adresa"  required type="text" value="{{$pacient->address}}" class="form-control form-control-user @error('Adresa') is-invalid @enderror" placeholder="Adresa">
                        @if ($errors->has('Adresa'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Adresa') }}</small></strong>
                        </span>
                    @endif
                      </div>
                <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <input id="residence" name="Vendbanimi" required type="text" value="{{$pacient->residence}}" class="form-control form-control-user @error('Vendbanimi') is-invalid @enderror"  placeholder="Vendbanimi">
                          
                          @if ($errors->has('Vendbanimi'))
                          <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Vendbanimi') }}</small></strong>
                          </span>
                      @endif
                        </div>
                        <div class="col-sm-6">
                                <input id="city" name="Qyteti" required type="text" value="{{$pacient->city}}" class="form-control form-control-user @error('Qyteti') is-invalid @enderror" placeholder="Qyteti">
                                @if ($errors->has('Qyteti'))
                                <span class="help-block">
                                    <strong class="text-danger"><small>{{ $errors->first('Qyteti') }}</small></strong>
                                </span>
                            @endif
                              </div>
                </div>
                <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                        <input id="phone" name="Telefoni" required type="text" class="form-control form-control-user @error('Telefoni') is-invalid @enderror" value="{{$pacient->phone}}" placeholder="Numri i telefonit">      
                        @if ($errors->has('Telefoni'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('Telefoni') }}</small></strong>
                        </span>
                    @endif
                        </div>
                        <div class="col-sm-6">
                            <input id="email" name="email"  type="email"  value="{{$pacient->email}}" class="form-control form-control-user" placeholder="Email">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                <div class="form-group">
                        <a class="btn btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                          <button type="submit"  class="btn btn-circle btn-primary float-right"><i class="fa fa-pen"></i></button>
                        </div>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection