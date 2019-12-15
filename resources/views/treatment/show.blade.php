@extends('layouts.app')
@section('title','Treatment View')
@section('treatment','active')
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
              <h1 class="h4 text-gray-900 mb-4">Të dhënat e trajtimit</h1>
            </div>
            <table class="table table-striped ">
                    <tbody>
                        <tr>
                            <th>Pacienti:</th>
                            <td scope="row"><a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$treatment->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacientName($treatment->pacient_id)}}</td>
                        </tr>
                       
                        <tr>
                            <th>Data e fillimit</th>
                            <td scope="row">{{$treatment->starting_date}}</td>
                        </tr>
                        <tr>
                                <th>Kohëzgjatja:</th>
                                <td scope="row">{{$treatment->duration}} </td>
                        </tr>
                        @foreach($services as $service)
                        <tr>
                                <th>Shërbimi:</th>
                                <td scope="row">{{$service->name}} - {{$service->price}} €</td>
                        </tr>
                        @endforeach
                        </tbody>
                </table>
               
            <hr>
            <a class="btn btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                    <a href="/treatment/{{$treatment->id}}/edit"  class="btn btn-circle btn-primary"><i class="fa fa-pen"></i></a>
                    <button class="btn btn-circle btn-danger" data-toggle="modal" data-target="#fshijModal{{$treatment->id}}"><i class="fa fa-trash"></i></button>
                    <div class="modal fade" id="fshijModal{{$treatment->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$treatment->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fshijModalLabel{{$treatment->id}}">Fshij Vizitën</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    A jeni i sigurtë që doni të vazhdoni?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                    <form class="d-inline" method="POST" action="{{ route('treatment.destroy',$treatment->id)}}" accept-charset="UTF-8">
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