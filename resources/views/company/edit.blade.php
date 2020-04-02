@extends('layouts.app')
@section('title','Ndrysho Settings')
@section('dashboard','active')
@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-5 m-auto d-flex justify-content-center ">
              <img src="{{App\User::getLogo()}}" class="img-fluid" />
            </div>
            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Ndrysho Aranzhimet!</h1>
                </div>
                <form class="user" method="POST"  enctype="multipart/form-data" action="{{ url('/settings/save') }}">
                  {{ csrf_field() }}
                  <div class="form-group ">
                    <label class="text-xs" for="pacient">Emri i Ordinancës</label>
                    <input id="app_name" name="app_name" value="{{$settings->app_name}}" required type="text" class="form-control form-control-user"  placeholder="Emri i Ordinancës">
                                  
                                  @if ($errors->has('app_name'))
                                                  <span class="help-block">
                                                      <strong>{{ $errors->first('app_name') }}</strong>
                                                  </span>
                                              @endif
                </div>
                  <div class="form-group ">
                    <label class="text-xs"  for="data">Logoja</label>
                  <input id="logo" type="file" class="form-control" name="logo" placeholder="{{$settings->logo}}" >
                            @if ($errors->has('logo'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('logo') }}</strong>
                                              </span>
                                          @endif
                    </div>
                    <div class="form-group ">
                        <label class="text-xs"  for="data">Tema</label>
                    <select class="form-control form-control-user" id="theme" name="theme" placeholder="Tema">
                        <option @if($settings->theme == false) selected @else @endif value="0">E ndriquar</option>
                        <option @if($settings->theme == true) selected @else @endif value="1">E errët</option>
                    </select>
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