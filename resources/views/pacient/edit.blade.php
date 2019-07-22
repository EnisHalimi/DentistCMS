@extends('layouts.app')
@section('title','Pacient Edit')
@section('pacient','active')
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
                    <h1 class="h4 text-gray-900 mb-4">Ndrysho Pacientin {{$pacient->first_name}} {{$pacient->last_name}}</h1>
                </div>
            <form class="user" method="POST" action="{{ route('pacient.update',$pacient->id) }}">
                    {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group row">
                    <div class="col-sm-4 mb-3 mb-sm-0">
                                  <input id="first_name" name="first_name" value="{{$pacient->first_name}}" required type="text" class="form-control form-control-user"  placeholder="Emri">
                                  
                                  @if ($errors->has('first_name'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('first_name') }}</strong>
                                                  </span>
                                              @endif
                                </div>
                                <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input id="fathers_name" name="fathers_name" value="{{$pacient->fathers_name}}" required type="text" class="form-control form-control-user" placeholder="Emri Prindit">
                                        @if ($errors->has('fathers_name'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('fathers_name') }}</strong>
                                                  </span>
                                              @endif
                                      </div>
                                <div class="col-sm-4">
                                  <input id="last_name" name="last_name" required type="text" value="{{$pacient->last_name}}" class="form-control form-control-user" placeholder="Mbiemri">
                                  @if ($errors->has('last_name'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('last_name') }}</strong>
                                                  </span>
                                              @endif
                                </div>
                 </div>
                 <div class="form-group row">
                        <div class="col-sm-4 mb-3 mb-sm-0">
                          <input id="personal_number" name="personal_number" value="{{$pacient->personal_number}}" required type="text" class="form-control form-control-user"  placeholder="Numri Personal">
                          
                          @if ($errors->has('personal_number'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('personal_number') }}</strong>
                                          </span>
                                      @endif
                        </div>
                        <div class="col-sm-4 mb-3 mb-sm-0">
                                <input id="date_of_birth" name="date_of_birth" required  type="date" value="{{$pacient->date_of_birth}}" class="form-control form-control-user "96>
                                @if ($errors->has('date_of_birth'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('date_of_birth') }}</strong>
                                          </span>
                                      @endif
                              </div>
                        <div class="col-sm-4">
                                <div class="custom-control custom-checkbox small">
                                        <input type="radio"  name="gender" value="M" @if($pacient->gender == 'M') checked @else @endif  class="custom-control-input"  id="gender1">
                                        <label class="custom-control-label" for="gender1">Mashkull</label>
                                </div>
                                <div class="custom-control custom-checkbox small">
                                        <input type="radio"  name="gender" value="F" @if($pacient->gender == 'F') checked @else @endif   class="custom-control-input" id="gender2">
                                        <label class="custom-control-label" for="gender2">Femër</label>
                                </div>
                          @if ($errors->has('gender'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('gender') }}</strong>
                                          </span>
                                      @endif
                        </div>
                </div>
                <div class="form-group">
                        <input  id="address" name="address"  required type="text" value="{{$pacient->address}}" class="form-control form-control-user" placeholder="Adresa">
                        @if ($errors->has('address'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('address') }}</strong>
                                          </span>
                                      @endif
                      </div>
                <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                          <input id="residence" name="residence" required type="text" value="{{$pacient->residence}}" class="form-control form-control-user"  placeholder="Vendbanimi">
                          
                          @if ($errors->has('residence'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('residence') }}</strong>
                                          </span>
                                      @endif
                        </div>
                        <div class="col-sm-6">
                                <input id="city" name="city" required type="text" value="{{$pacient->city}}" class="form-control form-control-user" placeholder="Qyteti">
                                @if ($errors->has('city'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                            @endif
                              </div>
                </div>
                  <button type="submit"  class="btn btn-primary btn-user btn-block">
                  Ndrysho
                </button>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection