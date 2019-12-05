@extends('layouts.app')
@section('title','Pacient View')
@section('pacient','active')
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
                    <h1 class="h4 text-gray-900 mb-4">Të dhënat e pacientit</h1>
                </div>
                <table class="table table-striped ">
                        <tbody>
                            <tr>
                                <th>Emri:</th>
                                <td scope="row">{{$pacient->first_name}}</td>
                            </tr>
                            <tr>
                                <th>Emri i prindit:</th>
                                <td scope="row">{{$pacient->fathers_name}}</td>
                            </tr>
                           
                            <tr>
                                <th>Mbiemri:</th>
                                <td scope="row">{{$pacient->last_name}}</td>
                            </tr>
                            <tr>
                                    <th>Numri Personal:</th>
                                    <td scope="row">{{$pacient->personal_number}}</td>
                                </tr>
                            <tr>
                                <th>Gjinia:</th>
                                <td scope="row">{{$pacient->gender}} </td>
                            </tr>
                            <tr>
                                    <th>Data e lindjes:</th>
                                    <td scope="row">{{$pacient->date_of_birth}}</td>
                                </tr>
                               
                                <tr>
                                    <th>Adresa:</th>
                                    <td scope="row">{{$pacient->address}}</td>
                                </tr>
                                <tr>
                                    <th>Vendbanimi:</th>
                                    <td scope="row">{{$pacient->residence}} </td>
                                </tr>
                                <tr>
                                        <th>Qyteti:</th>
                                        <td scope="row">{{$pacient->city}} </td>
                                    </tr>
                                    <tr>
                                            <th>Telefoni:</th>
                                            <td scope="row">{{$pacient->phone}} </td>
                                        </tr>
                                        <tr>
                                                <th>Email:</th>
                                                <td scope="row">{{$pacient->email}} </td>
                                            </tr>
                        </tbody>
                    </table>
                <hr>
                <a class="btn btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                        <a href="/pacient/{{$pacient->id}}/edit"  class="btn btn-circle btn-primary"><i class="fa fa-pen"></i></a>
                        <button class="btn btn-circle btn-danger" data-toggle="modal" data-target="#fshijModal{{$pacient->id}}"><i class="fa fa-trash"></i></button>
                        <div class="modal fade" id="fshijModal{{$pacient->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$pacient->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fshijModalLabel{{$pacient->id}}">Fshij Pacientit</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        A jeni i sigurtë që doni të vazhdoni?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                        <form class="d-inline" method="POST" action="{{ route('pacient.destroy',$pacient->id)}}" accept-charset="UTF-8">
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
        <div class="card-body">
                <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Historiku</h1>
                    </div>
                <table class="table table-bordered"  width="100%" cellspacing="0">
                    <h3>Terminet</h3> <hr>
                        <thead class="bg-dark text-light">
                          <tr>
                            <th>Pacienti</th>
                            <th>Dentisti</th>
                            <th>Data</th>
                            <th>Ora</th>
                            <th>Menaxhimi</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($appointments)>0)  
                          @foreach($appointments as $appointment)
                            <tr>
                            <td>{{App\Pacient::getPacient($appointment->pacient_id)}}</td>
                            <td>{{App\User::getUser($appointment->user_id)}}</td>
                            <td>{{$appointment->date_of_appointment}}</td>
                            <td>{{$appointment->time_of_appointment}}</td>
                            <td><a class="btn btn-circle btn-secondary btn-sm" href="/appointment/{{$appointment->id}}"><i class="fa fa-eye"></i></a></td>
                            </tr>
                          @endforeach
                          @else
                          <tr>
                              <td colspan="5">Nuk ka të dhëna</td> </tr>
                          @endif
                        </tbody>
                      </table>
<hr class="mb-5">
<table class="table table-bordered"  width="100%" cellspacing="0">
        <h3>Vizitat</h3> <hr>
            <thead class="bg-dark text-light">
              <tr>
                <th>Pacienti</th>
                <th>Dentisti</th>
                <th>Data</th>
                <th>Ora</th>
                <th>Menaxhimi</th>
              </tr>
            </thead>
            <tbody>
              @if(count($visits)>0)  
              @foreach($visits as $visit)
                <tr>
                <td>{{App\Pacient::getPacient($visit->pacient_id)}}</td>
                <td>{{App\User::getUser($visit->user_id)}}</td>
                <td>{{$visit->date_of_visit}}</td>
                <td>{{$visit->time_of_visit}}</td>
                <td><a class="btn btn-circle btn-secondary btn-sm" href="/visit/{{$visit->id}}"><i class="fa fa-eye"></i></a></td>
                </tr>
              @endforeach
              @else
              <tr>
                  <td colspan="5">Nuk ka të dhëna</td> </tr>
              @endif
            </tbody>
          </table>

          <hr class="mb-5">
<table class="table table-bordered"  width="100%" cellspacing="0">
        <h3>Trajtimet</h3> <hr>
            <thead class="bg-dark text-light">
              <tr>
                <th>Pacienti</th>
                <th>Data e fillimit</th>
                <th>Kohëzgjatja</th>
                <th>Menaxhimi</th>
              </tr>
            </thead>
            <tbody>
              @if(count($treatments)>0)  
              @foreach($treatments as $treatment)
                <tr>
                <td>{{App\Pacient::getPacient($treatment->pacient_id)}}</td>
                <td>{{$treatment->starting_date}}</td>
                <td>{{$treatment->duration}}</td>
                <td><a class="btn btn-circle btn-secondary btn-sm" href="/treatment/{{$treatment->id}}"><i class="fa fa-eye"></i></a></td>
                </tr>
              @endforeach
              @else
              <tr>
                  <td colspan="5">Nuk ka të dhëna</td> </tr>
              @endif
            </tbody>
          </table>

          <hr class="mb-5">
<table class="table table-bordered"  width="100%" cellspacing="0">
        <h3>Raporti</h3> <hr>
            <thead class="bg-dark text-light">
              <tr>
                <th>Pacienti</th>
                <th>Trajtimi</th>
                <th>Data</th>
                <th>Menaxhimi</th>
              </tr>
            </thead>
            <tbody>
              @if(count($reports)>0)  
              @foreach($reports as $report)
                <tr>
                <td>{{App\Pacient::getPacient($report->pacient_id)}}</td>
                <td><a class="btn btn-circle btn-secondary btn-sm" href="/treatment/{{$report->treatment_id}}"><i class="fa fa-syringe"></i></a> {{App\Treatment::getStartingDate($report->treatment_id)}}</td>
                <td>{{$report->created_at}}</td>
                <td><a class="btn btn-circle btn-secondary btn-sm" href="/report/{{$report->id}}"><i class="fa fa-eye"></i></a></td>
                </tr>
              @endforeach
              @else
              <tr>
                  <td colspan="5">Nuk ka të dhëna</td> </tr>
              @endif
            </tbody>
          </table>

       
    </div>
      </div>
    </div>
@endsection