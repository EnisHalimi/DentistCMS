@extends('layouts.app')
@section('title','Appointments')
@section('appointment','active')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid mt-4">

  <!-- Page Heading -->
  <div class="row">
    <div class="col-sm-6">
      <h1 class="h3 mb-4 text-gray-800">Terminet</h1>
    </div>
    <div class="col-sm-6 ">
        <a href="/appointment/create" class="btn btn-success float-right"><i class="fa fa-plus"></i> Krijo</a>
      </div>
  </div>
  
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista e Termineve</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Pacienti</th>
              <th>Dentisti</th>
              <th>Data</th>
              <th>Ora</th>
              <th>Menaxhimi</th>
            </tr>
          </thead>
          <tbody>
            @if(count($appointments) > 0)
            @foreach($appointments as $appointment)
            <tr>
              <td>  <a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$appointment->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($appointment->pacient_id)}}</td>
              <td> <a class="btn btn-circle btn-secondary btn-sm" href="/user/{{$appointment->user_id}}"><i class="fa fa-user-md"></i></a> {{App\User::getUser($appointment->user_id)}}</td>
              <td>{{$appointment->date_of_appointment}}</td>
              <td>{{$appointment->time_of_appointment}}</td>
              <td>
                <a href="/appointment/{{$appointment->id}}" class="btn btn-secondary"><i class="fa fa-eye"></i> Shiko</a>
                <a href="/appointment/{{$appointment->id}}/edit"  class="btn btn-info"><i class="fa fa-pen"></i> Ndrysho</a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#fshijModal{{$appointment->id}}"><i class="fa fa-trash"></i> Fshij</button>
                <div class="modal fade" id="fshijModal{{$appointment->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$appointment->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fshijModalLabel{{$appointment->id}}">Fshij Përdoruesin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                A jeni i sigurtë që doni të vazhdoni?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                                <form class="d-inline" method="POST" action="{{ route('appointment.destroy',$appointment->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Fshij</button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div> 
              </td>
              
            </tr>
            @endforeach
            @else
            <tr>
              <td colspan="4">Nuk u gjetën termine</td>
            </tr>
            @endif
          </tbody>
        </table>
        {{ $appointments->appends(request()->query())->links() }}
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->  

@endsection