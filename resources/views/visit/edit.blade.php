@extends('layouts.app')
@section('title','Visit Edit')
@section('visit','active')
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <!-- Nested Row within Card Body -->
    <div class="row">
      <div class="col-lg-5 d-none d-lg-block ">
      <img src="https://www.onlinelogomaker.com/blog/wp-content/uploads/2017/09/Dental-Logo-Design.jpg" class="img-fluid" />
      </div>
      <div class="col-lg-7">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Ndrysho Vizitën!</h1>
          </div>
          <form class="user" method="POST" action="{{ route('visit.update',$visit->id) }}">
                 {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="form-group ">
                        <label class="text-xs" for="pacient">Pacienti</label>
                        <input  value="{{App\Pacient::getPacient($visit->pacient_id)}}" placeholder="Pacienti" class="form-control form-control-user" id="pacient" name="pacient"  data-toggle="dropdown" aria-haspopup="true" data-target="pacient-dropdown" aria-expanded="false" />
                        <input  hidden id="pacient-id" value="{{$visit->pacient_id}}"  name="pacient-id"/>
                        <div class="dropdown-menu w-75" id="dropdown-pacient">
                            <input type="text" class="form-control form-control-user" placeholder="Search.." id="search-pacient" onkeyup="filterPacientFunction()">
                            @foreach($pacients as $pacient)
                            <a onclick="document.getElementById('pacient').value = '{{$pacient->first_name.' '.$pacient->last_name.' '.$pacient->personal_number}}';
                                document.getElementById('pacient-id').value = '{{$pacient->id}}';" class="dropdown-item" >{{$pacient->first_name}} {{$pacient->last_name}} {{$pacient->personal_number}}</a>
                          @endforeach
                          </div>
                      @if ($errors->has('pacient'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pacient') }}</strong>
                                        </span>
                                    @endif
                    </div>
                    <div class="form-group ">
                            <label class="text-xs" for="user">Dentisti</label>
                            <input  value="{{App\User::getUser($visit->user_id)}}" placeholder="Dentisti" class="form-control form-control-user" id="user" name="user"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" />
                            <input  hidden id="user-id"  value="{{$visit->user_id}}" name="user-id"/>
                            <div class="dropdown-menu w-75" id="dropdown-user">
                                <input type="text" class="form-control form-control-user" placeholder="Search.." id="search-user" onkeyup="filterUserFunction()">
                                 @foreach($users as $user)
                            <a onclick="document.getElementById('user').value = '{{$user->name}}';
                                document.getElementById('user-id').value = '{{$user->id}}';" class="dropdown-item" >{{$user->name}}</a>
                          @endforeach
                          </div>
                            @if ($errors->has('user'))
                                              <span class="help-block">
                                                  <strong>{{ $errors->first('user') }}</strong>
                                              </span>
                                          @endif
                    </div>
            <div class="form-group ">
                    <label class="text-xs"  for="data">Data e Vizitës</label>
                    <input type="date" value="{{$visit->date_of_visit}}" class="form-control form-control-user" required="" name="data" id="data" min="{{date('Y-m-d',strtotime('tomorrow'))}}" placeholder="Data e Vizitës">
                    @if ($errors->has('data'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('data') }}</strong>
                                      </span>
                                  @endif
            </div>
            
            <div class="form-group">
                    <label class="text-xs"  for="time">Ora e Vizitës</label>
                    <select class="form-control form-control-user" id="time" name="time" placeholder="Ora"> 
                      <option @if($visit->time_of_visit == "08:00") selected @else @endif>08:00</option>
                      <option @if($visit->time_of_visit == "08:30") selected @else @endif>08:30</option>
                      <option  @if($visit->time_of_visit == "09:00") selected @else @endif>09:00</option>
                      <option @if($visit->time_of_visit == "09:30") selected @else @endif>09:30</option>
                      <option @if($visit->time_of_visit == "10:00") selected @else @endif>10:00</option>
                      <option @if($visit->time_of_visit == "10:30") selected @else @endif>10:30</option>
                      <option @if($visit->time_of_visit == "11:00") selected @else @endif>11:00</option>
                      <option @if($visit->time_of_visit == "11:30") selected @else @endif>11:30</option>
                      <option @if($visit->time_of_visit == "12:00") selected @else @endif>12:00</option>
                      <option @if($visit->time_of_visit == "12:30") selected @else @endif>12:30</option>
                      <option @if($visit->time_of_visit == "13:00") selected @else @endif>13:00</option>
                      <option @if($visit->time_of_visit == "13:30") selected @else @endif>13:30</option>
                      <option @if($visit->time_of_visit == "14:00") selected @else @endif>14:00</option>
                      <option @if($visit->time_of_visit == "14:30") selected @else @endif>14:30</option>
                      <option @if($visit->time_of_visit == "15:00") selected @else @endif>15:00</option>
                      <option @if($visit->time_of_visit == "15:30") selected @else @endif>15:30</option>
                      <option @if($visit->time_of_visit == "16:00") selected @else @endif>16:00</option>
                      <option @if($visit->time_of_visit == "16:30") selected @else @endif>16:30</option>
                      <option @if($visit->time_of_visit == "17:00") selected @else @endif>17:00</option>
                      <option @if($visit->time_of_visit == "17:30") selected @else @endif>17:30</option>
                      <option @if($visit->time_of_visit == "18:00") selected @else @endif>18:00</option>
                      <option @if($visit->time_of_visit == "18:30") selected @else @endif>18:30</option>
                      <option @if($visit->time_of_visit == "19:00") selected @else @endif>19:00</option>
                      <option @if($visit->time_of_visit == "19:30") selected @else @endif>19:30</option>
                    </select>
            </div>
              <button type="submit"  class="btn btn-primary btn-user btn-block">
              Ndrysho
            </button>
          </form>
          <hr>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection