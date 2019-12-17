@extends('layouts.app')
@section('title','Kryefaqja')
@section('dashboard','active')
@section('content')
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kryefaqja</h1>
            <a href="/appointment/create" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-calendar fa-sm text-white-50"></i> Krijo Termin</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Terminet sot</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{App\Appointment::getAppointmentNumberToday(date('Y-m-d'))}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Faturat sot</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($reports)}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-scroll fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Vizitat sot</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{count($visits)}}</div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-eye fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Trajtimet sot</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($treatments)}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-syringe fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Terminet javore</h6>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Më shumë:</div>
                      <a class="dropdown-item" href="/appointment">Shiko të gjithë terminet</a>
                      <a class="dropdown-item" href="/appointment/create">Krijo termin të re</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class="card-body  py-0">
                    <table class="table table-bordered table-stripped">
                        <thead>
                          <th>Ora</th>
                          <th>Hënë</th>
                          <th>Marte</th>
                          <th>Mërkure</th>
                          <th>Enjte</th>
                          <th>Premte</th>
                          <th>Shtune</th>
                        </thead>
                        <tbody>
                          <tr>
                            <td>08:00 / 08:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("08:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("08:30", $days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("08:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("08:30", $days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("08:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("08:30", $days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("08:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("08:30", $days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("08:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("08:30", $days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("08:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("08:30", $days[5])}}</td>
                          </tr> 
                          <tr>
                            <td>09:00 / 09:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("09:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("09:30", $days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("09:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("09:30", $days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("09:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("09:30", $days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("09:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("09:30", $days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("09:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("09:30", $days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("09:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("09:30", $days[5])}}</td>
                          </tr>
                          <tr>
                            <td>10:00 / 10:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("10:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("10:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("10:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("10:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("10:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("10:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("10:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("10:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("10:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("10:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("10:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("10:30",$days[5])}}</td>
                          </tr>
                          <tr>
                            <td>11:00 / 11:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("11:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("11:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("11:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("11:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("11:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("11:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("11:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("11:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("11:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("11:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("11:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("11:30",$days[5])}}</td>
                          </tr>
                          <tr>
                            <td>12:00 / 12:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("12:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("12:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("12:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("12:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("12:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("12:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("12:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("12:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("12:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("12:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("12:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("12:30",$days[5])}}</td>
                          </tr>
                          <tr>
                            <td>13:00 / 13:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("13:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("13:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("13:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("13:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("13:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("13:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("13:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("13:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("13:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("13:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("13:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("13:30",$days[5])}}</td>
                          </tr>
                          <tr>
                            <td>14:00 / 14:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("14:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("14:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("14:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("14:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("14:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("14:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("14:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("14:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("14:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("14:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("14:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("14:30",$days[5])}}</td>
                          </tr>
                          <tr>
                            <td>15:00 / 15:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("15:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("15:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("15:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("15:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("15:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("15:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("15:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("15:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("15:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("15:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("15:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("15:30",$days[5])}}</td>
                          </tr>
                          <tr>
                            <td>16:00 / 16:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("16:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("16:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("16:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("16:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("16:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("16:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("16:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("16:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("16:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("16:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("16:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("16:30",$days[5])}}</td>

                          </tr>
                          <tr>
                            <td>17:00 / 17:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("17:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("17:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("17:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("17:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("17:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("17:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("17:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("17:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("17:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("17:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("17:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("17:30",$days[5])}}</td>
                          </tr>
                          <tr>
                            <td>18:00 / 18:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("18:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("18:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("18:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("18:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("18:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("18:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("18:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("18:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("18:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("18:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("18:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("18:30",$days[5])}}</td>
                          </tr>
                          <tr>
                            <td>19:00 / 19:30</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("19:00", $days[0])}} / {{App\Appointment::getAppointmentByTimeAndDate("19:30",$days[0])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("19:00", $days[1])}} / {{App\Appointment::getAppointmentByTimeAndDate("19:30",$days[1])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("19:00", $days[2])}} / {{App\Appointment::getAppointmentByTimeAndDate("19:30",$days[2])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("19:00", $days[3])}} / {{App\Appointment::getAppointmentByTimeAndDate("19:30",$days[3])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("19:00", $days[4])}} / {{App\Appointment::getAppointmentByTimeAndDate("19:30",$days[4])}}</td>
                            <td>{{App\Appointment::getAppointmentByTimeAndDate("19:00", $days[5])}} / {{App\Appointment::getAppointmentByTimeAndDate("19:30",$days[5])}}</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
              </div>
            </div>


          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Content Column -->
            <div class="col-lg-6 mb-4">

              <!-- Project Card Example -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Pacientët sot</h6>
                </div>
                <div class="card-body py-0 scroll">
                    <table class="table table-stripped">
                        <thead>
                          <th>Emri</th>
                          <th>Mbiemri</th>
                          <th>Data e lindjes</th>
                          <th>Vendbanimi</th>
                          <th>Detajet</th>
                        </thead>
                        <tbody>
                            @if(count($pacients) > 0)
                            @foreach($pacients as $pacient)
                          <tr>
                            <td>{{$pacient->first_name}}</td>
                            <td>{{$pacient->last_name}}</td>
                            <td>{{$pacient->date_of_birth}}</td>
                            <td>{{$pacient->residence}}</td>
                            <td><a href="/pacient/{{$pacient->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>
    
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td colspan="5">Nuk janë regjistuar Pacientë sot</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
              </div>
              </div>
            </div>

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Raportet</h6>
                </div>
                <div class="card-body py-0 scroll">
                    <table class="table table-stripped">
                        <thead>
                          <th>Pacienti</th>
                          <th>Trajtimi</th>
                          <th>Data</th>
                          <th>Detajet</th>
                        </thead>
                        <tbody>
                            @if(count($reports) > 0)
                            @foreach($reports as $report)
                          <tr>
                            <td>{{App\Pacient::getPacientName($report->pacient_id)}}</td>
                            <td>{{App\Treatment::getStartingDate($report->treatment_id)}}</td>
                            <td>{{date('d/m/Y',strtotime($report->created_at))}}</td>
                            <td><a href="/report/{{$report->id}}" class="btn btn-circle btn-secondary btn-sm"><i class="fa fa-eye"></i></a> </td>
    
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td colspan="4">Nuk janë regjistuar Raporte sot</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
              </div>
              </div>


            </div>
          </div>

        </div>
        <!-- /.container-fluid -->


 @endsection
  
