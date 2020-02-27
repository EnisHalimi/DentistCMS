@extends('layouts.app')
@section('title','Settings')
@section('dashboard','active')
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
              <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Aranzhimet</h1>
            </div>
            <table class="table table-striped ">
                    <tbody>
                        <tr>
                            <th>Emri i Ordinancës:</th>
                            <td scope="row">{{$settings->app_name}}</td>
                        </tr>
                        <tr>
                            <th>Logoja:</th>
                        <td scope="row"><img src=" @if(substr($settings->logo, 0, 4 ) === "http")
                          {{$settings->logo}}
                          @else 	
                          {{asset('img/'.$settings->logo.'')}} @endif" class="img-fluid" /></td>
                        </tr>
                       
                        <tr>
                            <th>Tema:</th>
                            <td scope="row">
                                @if($settings->theme)
                                E errët
                                @else
                                E ndriquar  
                                @endif
                            </td>
                        </tr>
                       
                        </tbody>
                </table>
               
            <hr>
            <a href="settings/edit" class="btn btn-circle btn-primary"><i class="fa fa-pen"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection