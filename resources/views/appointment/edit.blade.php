@extends('layouts.app')
@section('title','Ndrysho Termin')
@section('appointment','active')
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
                <h1 class="h4 text-gray-900 mb-4">Ndrysho Termin!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('appointment.update',$appointment->id) }}">
                     {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="form-group ">
                            <label class="text-xs" for="pacient">Pacienti</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
                                </div>
                            <input readonly value="{{App\Pacient::getPacient($appointment->pacient_id)}}" placeholder="Pacienti" class="form-control form-control-user @error('pacient-id') is-invalid @enderror" id="pacient" name="pacient"   data-toggle="modal" data-target="#pacientModal" />
                            <input  hidden id="pacient-id" value="{{$appointment->pacient_id}}"  name="pacient-id"/>
                            <div class="input-group-append">
                                <button type="button"  class="btn btn-outline-danger" onclick="document.getElementById('pacient').value=''; document.getElementById('pacient-id').value='';" >
                                  <i class="fa fa-trash"></i>
                                </button>
                              </div>
                            <div class="modal fade" id="pacientModal" tabindex="-1" role="dialog" aria-labelledby="pacientModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="pacientModalLabel">Zgjedh Pacientin</h5>
                                    </div>
                                    <div class="modal-body mx-2">
                                      <table class="table table-bordered table-hover"  width="100%" cellspacing="0" id="searchPacient">
                                        <thead class="bg-dark text-light">
                                          <tr>
                                            <th scope="col">Emri</th>
                                            <th scope="col">Mbiemri</th>
                                            <th scope="col">Nr Personal</th>
                                            <th scope="col">Shto</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                      </table>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                              @if ($errors->has('pacient-id'))
                              <span class="help-block">
                                  <strong class="text-danger"><small>{{ $errors->first('pacient-id') }}</small> </strong>
                              </span>
                          @endif
                        </div>
                        <div class="form-group ">
                                <label class="text-xs" for="user">Dentisti</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#userModal"><i class="fa fa-plus"></i> </button>
                                    </div>
                                <input readonly value="{{App\User::getUser($appointment->user_id)}}" placeholder="Dentisti" class="form-control form-control-user @error('user-id') is-invalid @enderror" id="user" name="user" data-toggle="modal" data-target="#userModal"  />
                                <input  hidden id="user-id"  value="{{$appointment->user_id}}" name="user-id"/>
                                <div class="input-group-append">
                                    <button type="button"  class="btn btn-outline-danger" onclick="document.getElementById('user').value=''; document.getElementById('user-id').value='';" >
                                      <i class="fa fa-trash"></i>
                                    </button>
                                  </div>
                            </div>
                                <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="userModalLabel">Zgjedh Dentistin</h5>
                                        </div>
                                        <div class="modal-body">
                                          <table class="table table-bordered table-hover"  width="100%" cellspacing="0" id="searchUser" >
                                            <thead class="bg-dark text-light">
                                            <tr>
                                            <th>Dentisti</th>
                                            <th>E-Mail</th>
                                            <th>Shto</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                          </table>
                                            
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div> 
                                  @if ($errors->has('user-id'))
                                  <span class="help-block">
                                    <strong class="text-danger"><small>{{ $errors->first('user-id') }}</small></strong>
                                  </span>
                              @endif
                        </div>
                <div class="form-group ">
                        <label class="text-xs"  for="data">Data e Terminit</label>
                        <input type="date" value="{{$appointment->appointment_date}}" class="form-control form-control-user @error('data') is-invalid @enderror" required="" name="data" id="data" min="{{date('Y-m-d',strtotime('tomorrow'))}}" placeholder="Data e Terminit">
                        @if ($errors->has('data'))
                                          <span class="help-block">
                                            <strong class="text-danger"><small>{{ $errors->first('data') }}</small></strong>
                                          </span>
                                      @endif
                </div>
                
                <div class="form-group">
                        <label class="text-xs"  for="time">Ora e Terminit</label>
                        <select class="form-control form-control-user @error('time') is-invalid @enderror" id="time" name="time" placeholder="Ora"> 
                          <option @if($appointment->time_of_appointment == "08:00") selected @else @endif>08:00</option>
                          <option @if($appointment->time_of_appointment == "08:30") selected @else @endif>08:30</option>
                          <option  @if($appointment->time_of_appointment == "09:00") selected @else @endif>09:00</option>
                          <option @if($appointment->time_of_appointment == "09:30") selected @else @endif>09:30</option>
                          <option @if($appointment->time_of_appointment == "10:00") selected @else @endif>10:00</option>
                          <option @if($appointment->time_of_appointment == "10:30") selected @else @endif>10:30</option>
                          <option @if($appointment->time_of_appointment == "11:00") selected @else @endif>11:00</option>
                          <option @if($appointment->time_of_appointment == "11:30") selected @else @endif>11:30</option>
                          <option @if($appointment->time_of_appointment == "12:00") selected @else @endif>12:00</option>
                          <option @if($appointment->time_of_appointment == "12:30") selected @else @endif>12:30</option>
                          <option @if($appointment->time_of_appointment == "13:00") selected @else @endif>13:00</option>
                          <option @if($appointment->time_of_appointment == "13:30") selected @else @endif>13:30</option>
                          <option @if($appointment->time_of_appointment == "14:00") selected @else @endif>14:00</option>
                          <option @if($appointment->time_of_appointment == "14:30") selected @else @endif>14:30</option>
                          <option @if($appointment->time_of_appointment == "15:00") selected @else @endif>15:00</option>
                          <option @if($appointment->time_of_appointment == "15:30") selected @else @endif>15:30</option>
                          <option @if($appointment->time_of_appointment == "16:00") selected @else @endif>16:00</option>
                          <option @if($appointment->time_of_appointment == "16:30") selected @else @endif>16:30</option>
                          <option @if($appointment->time_of_appointment == "17:00") selected @else @endif>17:00</option>
                          <option @if($appointment->time_of_appointment == "17:30") selected @else @endif>17:30</option>
                          <option @if($appointment->time_of_appointment == "18:00") selected @else @endif>18:00</option>
                          <option @if($appointment->time_of_appointment == "18:30") selected @else @endif>18:30</option>
                          <option @if($appointment->time_of_appointment == "19:00") selected @else @endif>19:00</option>
                          <option @if($appointment->time_of_appointment == "19:30") selected @else @endif>19:30</option>
                        </select>
                        @if ($errors->has('time'))
                        <span class="help-block">
                          <strong class="text-danger"><small>{{ $errors->first('data') }}</small></strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <a class="btn btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                      <button type="submit"  class="btn btn-circle btn-primary float-right"><i class="fa fa-pen"></i></button>
                    </div>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
 
@endsection