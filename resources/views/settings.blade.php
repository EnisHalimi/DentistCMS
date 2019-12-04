@extends('layouts.app')
@section('title','Settings')
@section('dashboard','active')
@section('content')

<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-5 d-flex justify-content-center ">
        <img src="{{App\User::getLogo()}}" class="img-fluid" />
        </div>
        <div class="col-lg-7">
          <div class="p-5">
            <div class="text-center">
              <h1 class="h4 text-gray-900 mb-4">Aranzhimet</h1>
            </div>
            <table class="table table-striped ">
                    <tbody>
                        <tr>
                            <th>Emri i Ordinancës:</th>
                            <td scope="row">{{$settings->app_name}}</td>
                        </tr>
                        <tr>
                            <th>Logoja:</th>
                        <td scope="row"><img src="{{asset('img/'.$settings->logo.'')}}" class="img-fluid" /></td>
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
            
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection