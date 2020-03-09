@extends('layouts.app')
@section('title','Shiko Rolin')
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
                  <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Të dhënat e rolit</h1>
                </div>
                <table class="table table-striped ">
                        <tbody>
                            <tr>
                                <th>Emri:</th>
                                <td scope="row">{{$role->name}}</td>
                            </tr>
                            <tr>
                                <th>Pacienti:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-pacient')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-pacient')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-pacient')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-pacient')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            <tr>
                                <th>Termine:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-appointment')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-appointment')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-appointment')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-appointment')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            <tr>
                                <th>Vizita:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-visit')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-visit')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-visit')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-visit')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            <tr>
                                <th>Tratime:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-treatment')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-treatment')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-treatment')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-treatment')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            <tr>
                                <th>Raporte:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-report')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-report')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-report')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-report')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            <tr>
                                <th>Sherbime:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-services')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-services')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-services')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-services')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            <tr>
                                <th>Perdoruesit:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-user')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-user')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-user')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-user')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            <tr>
                                <th>Rolet:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-role')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-role')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-role')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-role')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            <tr>
                                <th>Borgji:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-debt')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-debt')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-debt')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-debt')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            <tr>
                                <th>Fatura:</th>
                                <td scope="row"> Shiko @if(App\Role::hasPermission($role->id, 'view-bill')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif| 
                                    Krjio @if(App\Role::hasPermission($role->id, 'create-bill')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Ndrysho @if(App\Role::hasPermission($role->id, 'edit-bill')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif | 
                                    Fshij @if(App\Role::hasPermission($role->id, 'delete-bill')) <i class="fa fa-check-square"></i> @else <i class="fa fa-square"></i> @endif</td>
                            </tr>
                            </tbody>
                    </table>
                   
                <hr>
                <a class="btn btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                        <a href="/role/{{$role->id}}/edit"  class="btn btn-circle btn-primary"><i class="fa fa-pen"></i></a>
                        <button class="btn btn-circle btn-danger" data-toggle="modal" data-target="#fshijModal{{$role->id}}"><i class="fa fa-trash"></i></button>
                        <div class="modal fade" id="fshijModal{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$role->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fshijModalLabel{{$role->id}}">Fshij Rolin</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        A jeni i sigurtë që doni të vazhdoni?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn  btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                        <form class="d-inline" method="POST" action="{{ route('role.destroy',$role->id)}}" accept-charset="UTF-8">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div> 
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection