@extends('layouts.app')
@section('title','Appointment Register')
@section('appointment','active')
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
                <h1 class="h4 text-gray-900 mb-4">Shto Termin!</h1>
              </div>
              <form class="user" method="POST" action="{{ route('user.store') }}">
                        {{ csrf_field() }}
                <div class="form-group ">
                    <label class="text-xs" for="pacient">Pacienti</label>
                  <input id="pacient" name="pacient" value="{{ old('pacient') }}" required autofocus type="text" class="form-control form-control-user"  placeholder="Pacienti">
                  <input id="pacient_id" name="pacient_id" hidden value="0">
                  @if ($errors->has('pacient'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pacient') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group ">
                        <label class="text-xs" for="user">Dentisti</label>
                        <input id="user" name="user" value="{{ old('user') }}" required autofocus type="text" class="form-control form-control-user"  placeholder="Dentisti">
                        <input id="user_id" name="user_id" hidden value="0">
                        @if ($errors->has('user'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('user') }}</strong>
                                          </span>
                                      @endif
                </div>
                <div class="form-group ">
                        <label class="text-xs"  for="data">Data e Terminit</label>
                        <input type="date" class="form-control form-control-user" required="" name="data" id="data" min="{{date('Y-m-d',strtotime('tomorrow'))}}" placeholder="Data e Terminit">
                        @if ($errors->has('data'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('data') }}</strong>
                                          </span>
                                      @endif
                </div>
                
                <div class="form-group">
                        <label class="text-xs"  for="time">Ora e Terminit</label>
                        <select class="form-control form-control-user" id="time" name="time" placeholder="Ora"> 
                          <option>08:00</option>
                          <option>08:30</option>
                          <option>09:00</option>
                          <option>09:30</option>
                          <option>10:00</option>
                          <option>10:30</option>
                          <option>11:00</option>
                          <option>11:30</option>
                          <option>12:00</option>
                          <option>12:30</option>
                          <option>13:00</option>
                          <option>13:30</option>
                          <option>14:00</option>
                          <option>14:30</option>
                          <option>15:00</option>
                          <option>15:30</option>
                          <option>16:00</option>
                          <option>16:30</option>
                          <option>17:00</option>
                          <option>17:30</option>
                          <option>18:00</option>
                          <option>18:30</option>
                          <option>19:00</option>
                          <option>19:30</option>
                        </select>
                </div>
                  <button type="submit"  class="btn btn-primary btn-user btn-block">
                  Regjistro
                </button>
              </form>
              <hr>
            </div>
          </div>
        </div>
      </div>
    </div>
 
@endsection