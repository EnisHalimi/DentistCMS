@extends('layouts.app')
@section('title','Raporti Ditor')
@section('daily','active')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mt-4">
<!-- Page Heading -->
<div class="row">
  <div class="col-sm-6">
    <h1 class="h3 mb-4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-800 @endif">Raporti Ditor</h1>
  </div>
  <div class="col-sm-3 ">
 
  </div>
  <div class="col-sm-3 ">
    <form id="daily-form" method="GET" action="{{url('/daily')}}">
    <div class="form-inline">
      <label class="mr-2" for="date">Data </label>
      <input class="form-control" value="{{$date}}" type="date" id="dateDaily" name="date">
    </div>
    </form>
    </div>
</div>


<!-- DataTales Example -->
<div class="row">
  <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="pacient-tab" data-toggle="tab" href="#pacient" role="tab" aria-controls="pacient"
        aria-selected="true">Paciente</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="appointment-tab" data-toggle="tab" href="#appointment" role="tab" aria-controls="appointment"
        aria-selected="false">Termine</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="visit-tab" data-toggle="tab" href="#visit" role="tab" aria-controls="convisittact"
        aria-selected="false">Vizita</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="treatment-tab" data-toggle="tab" href="#treatment" role="tab" aria-controls="treatment"
        aria-selected="false">Trajtime</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="report-tab" data-toggle="tab" href="#report" role="tab" aria-controls="report"
        aria-selected="false">Raporte</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="bill-tab" data-toggle="tab" href="#bill" role="tab" aria-controls="bill"
        aria-selected="false">Shpenzimet</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="debt-tab" data-toggle="tab" href="#debt" role="tab" aria-controls="debt"
        aria-selected="false">Borgjet</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="payment-tab" data-toggle="tab" href="#payment" role="tab" aria-controls="payment"
        aria-selected="false">Pagesat</a>
    </li>
  </ul>
  <div class="tab-content w-100" id="myTabContent">
    <div class="tab-pane fade show active" id="pacient" role="tabpanel" aria-labelledby="pacient-tab">
      <div class="container-fluid mt-4">
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e pacientëve</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%"  cellspacing="0" >
                <thead>
                  <tr>
                    <th>Emri</th>
                    <th>Mbiemri</th>
                    <th>Numri Personal</th>
                    <th>Data e lindjes</th>
                    <th>Adresa</th>
                    <th>Vendbanimi</th>
                    <th>Shiko</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($pacients) > 0)
                  @foreach($pacients as $pacient)
                <tr>
                  <td>{{$pacient->first_name}}</td>
                  <td>{{$pacient->last_name}}</td>
                  <td>{{$pacient->personal_number}}</td>
                  <td>{{$pacient->date_of_birth}}</td>
                  <td>{{$pacient->address}}</td>
                  <td>{{$pacient->residence}}</td>
                  <td><a href="/pacient/{{$pacient->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>

                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="7">Nuk janë regjistuar Pacientë</td>
                </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
      </div>
     </div>
    <div class="tab-pane fade" id="appointment" role="tabpanel" aria-labelledby="appointment-tab"> 
      <div class="container-fluid mt-4">
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e termineve</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%"  cellspacing="0" >
                <thead>
                  <tr>
                    <th>Pacienti</th>
                    <th>Dentisti</th>
                    <th>Data</th>
                    <th>Ora</th>
                    <th>Shiko</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($appointements) > 0)
                  @foreach($appointements as $appointment)
                <tr>
                  <td><a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$appointment->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($appointment->pacient_id)}}</td>
                  <td><a class="btn btn-circle btn-secondary btn-sm" href="/user/{{$appointment->user_id}}"><i class="fa fa-user-md"></i></a> {{App\User::getUser($appointment->user_id)}}</td>
                  <td>{{$appointment->date_of_appointment}}</td>
                  <td>{{$appointment->time_of_appointment}}</td>
                  <td><a href="/appointment/{{$appointment->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>

                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="7">Nuk janë regjistuar Termine</td>
                </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
      </div>

    </div>
    <div class="tab-pane fade" id="visit" role="tabpanel" aria-labelledby="visit-tab"> 
      <div class="container-fluid mt-4">
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e vizitave</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%"  cellspacing="0" >
                <thead>
                  <tr>
                    <th>Pacienti</th>
                    <th>Dentisti</th>
                    <th>Data</th>
                    <th>Ora</th>
                    <th>Shiko</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($visit) > 0)
                  @foreach($visit as $vs)
                <tr>
                  <td><a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$vs->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($vs->pacient_id)}}</td>
                  <td><a class="btn btn-circle btn-secondary btn-sm" href="/user/{{$vs->user_id}}"><i class="fa fa-user-md"></i></a> {{App\User::getUser($vs->user_id)}}</td>
                  <td>{{$vs->date_of_visit}}</td>
                  <td>{{$vs->time_of_visit}}</td>
                  <td><a href="/visit/{{$vs->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>

                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="7">Nuk janë regjistuar vizita</td>
                </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
      </div>
    </div>
    <div class="tab-pane fade" id="treatment" role="tabpanel" aria-labelledby="treatment-tab"> 
      <div class="container-fluid mt-4">
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e trajtimeve</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%"  cellspacing="0" >
                <thead>
                  <tr>
                    <th>Pacienti</th>
                    <th>Data e Fillimit</th>
                    <th>Kohëzgjatja</th>
                    <th>Shiko</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($treatment) > 0)
                  @foreach($treatment as $tr)
                <tr>
                  <td><a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$tr->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($tr->pacient_id)}}</td>
                  <td>{{$tr->starting_date}}</td>
                  <td>{{$tr->duration}}</td>
                  <td><a href="/treatment/{{$tr->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>

                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="7">Nuk janë regjistuar Trajtime</td>
                </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
      </div>
    </div>
    <div class="tab-pane fade" id="report" role="tabpanel" aria-labelledby="report-tab"> 
      <div class="container-fluid mt-4">
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e raportave</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%"  cellspacing="0" >
                <thead>
                  <tr>
                    <th>Pacienti</th>
                    <th>Mjeku</th>
                    <th>Data</th>
                    <th>Shiko</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($reports) > 0)
                  @foreach($reports as $report)
                <tr>
                  <td><a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$report->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($report->pacient_id)}}</td>
                  <td><a class="btn btn-circle btn-secondary btn-sm" href="/user/{{$report->user_id}}"><i class="fa fa-user-md"></i></a> {{App\User::getUser($report->user_id)}}</td>
                  <td>{{$report->created_at}}</td>
                  <td><a href="/report/{{$report->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>

                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="7">Nuk janë regjistuar Raporte</td>
                </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
      </div>
    </div>
    <div class="tab-pane fade" id="bill" role="tabpanel" aria-labelledby="bill-tab"> 
      <div class="container-fluid mt-4">
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e shpenzimeve</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%"  cellspacing="0" >
                <thead>
                  <tr>
                    <th>Subjekti</th>
                    <th>Nr i Faturës</th>
                    <th>Afati</th>
                    <th>Vlera</th>
                    <th>Shiko</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($bill) > 0)
                  @foreach($bill as $b)
                <tr>
                  <td>{{$b->subject}}</td>
                  <td>{{$b->bill_nr}}</td>
                  <td>{{$b->deadline}}</td>
                  <td>{{$b->value}} €</td>
                  <td><a href="/bill/{{$b->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>

                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="7">Nuk janë regjistuar Shpenzime</td>
                </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
      </div>
    </div>
    <div class="tab-pane fade" id="debt" role="tabpanel" aria-labelledby="debt-tab"> 
      <div class="container-fluid mt-4">
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e borgjeve</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%"  cellspacing="0" >
                <thead>
                  <tr>
                    <th>Pacienti</th>
                    <th>Afati</th>
                    <th>Vlera</th>
                    <th>Shiko</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($debt) > 0)
                  @foreach($debt as $d)
                <tr>
                  <td><a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$d->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($d->pacient_id)}}</td>
                  <td>{{$d->deadline}}</td>
                  <td>{{$d->value}} €</td>
                  <td><a href="/debt/{{$d->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>

                </tr>
                @endforeach
                @else
                <tr>
                  <td colspan="7">Nuk janë regjistuar Borgje</td>
                </tr>
                @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
      </div>
    </div>
    <div class="tab-pane fade" id="payment" role="tabpanel" aria-labelledby="payment-tab"> 
      <div class="container-fluid mt-4">
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e pagesave</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" width="100%"  cellspacing="0" >
                <thead>
                  <tr>
                    <th>Pacienti</th>
                    <th>Vlera</th>
                    <th>Data</th>
                    <th>Shiko</th>
                  </tr>
                </thead>
                <tbody>
                    @if(count($payment) > 0)
                    @foreach($payment as $p)
                  <tr>
                    <td><a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$p->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($p->pacient_id)}}</td>
                    <td>{{$p->value}} €</td>
                    <td>{{$p->created_at}}</td>
                    <td><a href="/payment/{{$p->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>
  
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="7">Nuk janë regjistuar Borgje</td>
                  </tr>
                  @endif
                </tbody>
              </table>
            </div>
          </div>
        </div>
      
      </div>
    </div>
  </div>


  </div>
</div>
 
@endsection