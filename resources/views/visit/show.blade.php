@extends('layouts.app')
@section('title','Shiko Vizit')
@section('visit','active')
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
              <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Të dhënat e vizitës</h1>
            </div>
            <table class="table table-striped ">
                    <tbody>
                        <tr>
                            <th>Pacienti:</th>
                            <td scope="row"><a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$visit->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($visit->pacient_id)}}</td>
                        </tr>
                        <tr>
                            <th>Dentisti:</th>
                            <td scope="row"><a class="btn btn-circle btn-secondary btn-sm" href="/user/{{$visit->user_id}}"><i class="fa fa-user-md"></i></a> {{App\User::getUser($visit->user_id)}}</td>
                        </tr>
                       
                        <tr>
                            <th>Data e vizitës:</th>
                            <td scope="row">{{$visit->date_of_visit}}</td>
                        </tr>
                        <tr>
                                <th>Ora e vizitës:</th>
                                <td scope="row">{{$visit->time_of_visit}} </td>
                            </tr>
                        </tbody>
                </table>
               
            <hr>
            <a class="btn btn-secondary btn-circle" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                    <a href="/visit/{{$visit->id}}/edit"  class="btn btn-primary btn-circle"><i class="fa fa-pen"></i></a>
                    <button class="btn btn-circle btn-danger" data-toggle="modal" data-target="#fshijModal{{$visit->id}}"><i class="fa fa-trash"></i></button>
                    <div class="modal fade" id="fshijModal{{$visit->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$visit->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fshijModalLabel{{$visit->id}}">Fshij Vizitën</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    A jeni i sigurtë që doni të vazhdoni?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    <form class="d-inline" method="POST" action="{{ route('visit.destroy',$visit->id)}}" accept-charset="UTF-8">
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