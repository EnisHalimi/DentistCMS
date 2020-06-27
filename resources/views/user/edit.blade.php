@extends('layouts.app')
@section('title','Ndrysho Perdorues')
@section('settings','active')
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
                  <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Ndrysho Përdorues!</h1>
                </div>
                <form class="user" method="POST" action="{{ route('user.update',$user->id) }}">
                        {{ method_field('PUT') }}
                          {{ csrf_field() }}
                  <div class="form-group ">
                    <label class="text-xs"  for="name">Emri dhe Mbiemri</label>
                    <input id="name" name="Emri_dhe_Mbiemri" value="{{$user->name }}" required autofocus type="text" class="form-control form-control-user @error('Emri_dhe_Mbiemri') is-invalid @enderror"  placeholder="Emri dhe Mbiemri">
                    @if ($errors->has('Emri_dhe_Mbiemri'))
                    <span class="help-block">
                        <strong class="text-danger"><small>{{ $errors->first('Emri_dhe_Mbiemri') }}</small></strong>
                    </span>
                @endif
                  </div>
                  <div class="form-group">
                    <label class="text-xs"  for="email">E-mail</label>
                    <input  id="email" name="email" value="{{ $user->email }}" required type="email" class="form-control form-control-user @error('email') is-invalid @enderror" placeholder="Email Address">
                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="text-danger"><small>>{{ $errors->first('email') }}</small></strong>
                                    </span>
                                @endif
                  </div>
                  <div class="form-group">
                    <label class="text-xs"  for="role">Pozita</label>
                          <select class="form-control form-control-user @error('role') is-invalid @enderror" id="role" name="role" placeholder="Pozita">
                          @foreach($roles as $role)
                            <option @if($user->role_id == $role->id) selected @else @endif value="{{$role->id}}">{{$role->name}}</option>
                          @endforeach
                          </select>
                    @if ($errors->has('role'))
                                      <span class="help-block">
                                          <strong class="text-danger"><small>{{ $errors->first('role') }}</small></strong>
                                      </span>
                                  @endif
                  </div>
                  <div class="form-group">
                    <label class="text-xs"  for="color">Ngjyra</label>
                          <select class="form-control form-control-user @error('color') is-invalid @enderror" id="color" name="color" placeholder="Ngjyra">
                            <option @if($user->color === "#4e73df") selected @else @endif value="#4e73df">Kaltër</option>
                            <option @if($user->color === "#00008b") selected @else @endif value="#00008b">Kaltër e errët</option>
                            <option @if($user->color === "#6f42c1") selected @else @endif value="#6f42c1">Vjollce</option>
                            <option @if($user->color === "#e83e8c") selected @else @endif value="#e83e8c">Rozë</option>
                            <option @if($user->color === "#e74a3b") selected @else @endif value="#e74a3b">Kuqe</option>
                            <option @if($user->color === "#fd7e14") selected @else @endif value="#fd7e14">Portokalli</option>
                            <option @if($user->color === "#f6c23e") selected @else @endif value="#f6c23e">Verdhë</option>
                            <option @if($user->color === "#1cc88a") selected @else @endif value="#1cc88a">Gjelbërt</option>
                            <option @if($user->color === "#36b9cc") selected @else @endif value="#36b9cc">Gjelbërt e lehte</option>
                            <option @if($user->color === "#3a3b45") selected @else @endif value="#3a3b45">Hiri</option>
                            <option @if($user->color === "#000000") selected @else @endif value="#000000">Zezë</option>

                          </select>
                    @if ($errors->has('color'))
                                      <span class="help-block">
                                          <strong class="text-danger"><small>{{ $errors->first('color') }}</small></strong>
                                      </span>
                                  @endif
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                      <label class="text-xs"  for="password">Passwordi</label>
                      <input id="password" name="password"  type="password" class="form-control form-control-user @error('password') is-invalid @enderror"  placeholder="Lëre të zbrazët nëse nuk e ndryshon">
                      @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="text-danger"><small>{{ $errors->first('password') }}</small></strong>
                                    </span>
                                @endif
                    </div>
                    <div class="col-sm-6">
                      <label class="text-xs"  for="password-confirm">Përsërit Password</label>
                      <input id="password-confirm" name="password_confirmation"  type="password" class="form-control form-control-user @error('password') is-invalid @enderror" placeholder="Lëre të zbrazët nëse nuk e ndryshon">
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
