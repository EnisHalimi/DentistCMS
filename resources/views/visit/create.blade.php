@extends('layouts.app')
@section('title','Shto Vizit')
@section('visit','active')
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <div class="row">
      <div class="col-lg-5 m-auto d-flex justify-content-center ">
        <img src="{{App\User::getLogo()}}" class="img-fluid" />
      </div>
      <div class="col-lg-7">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Shto Vizitë!</h1>
          </div>
          <form class="user" method="POST" action="{{ route('visit.store') }}">
            {{ csrf_field() }}
            <div class="form-group ">
              <label class="text-xs" for="pacient">Pacienti</label>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
                </div>
              <input  readonly placeholder="Pacienti" value="{{ old('pacient') }}" class="form-control form-control-user @error('pacient-id') is-invalid @enderror" id="pacient" name="pacient"  />
              <input  hidden id="pacient-id" value="{{ old('pacient-id') }}" name="pacient-id"/>
              <div class="input-group-append">
                <button type="button"  class="btn btn-outline-danger" onclick="document.getElementById('pacient').value=''; document.getElementById('pacient-id').value='';" >
                  <i class="fa fa-trash"></i>
                </button>
              </div>
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
                      <input readonly  placeholder="Dentisti"  value="{{ old('user') }}" class="form-control form-control-user @error('user-id') is-invalid @enderror" id="user" name="user"  />
                      <input  hidden id="user-id"  value="{{ old('user-id') }}" name="user-id"/>
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
                      <label class="text-xs"  for="data">Data e Vizites</label>
              <input type="date" value="{{old('data')}}" class="form-control form-control-user @error('data') is-invalid @enderror" required="" name="data" id="data" max="{{date('Y-m-d')}}" placeholder="Data e Terminit">
                      @if ($errors->has('data'))
                      <span class="help-block">
                        <strong class="text-danger"><small>{{ $errors->first('data') }}</small></strong>
                      </span>
                  @endif
              </div>
              
              <div class="form-group">
                      <label class="text-xs"  for="time">Ora e Vizites</label>
                      <select class="form-control form-control-user  @error('time') is-invalid @enderror" id="time" name="time" placeholder="Ora"> 
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
                      @if ($errors->has('time'))
                      <span class="help-block">
                        <strong class="text-danger"><small>{{ $errors->first('data') }}</small></strong>
                      </span>
                  @endif
              </div>
              <div class="form-group">
                <a class="btn btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                  <button type="submit"  class="btn btn-circle btn-primary float-right"><i class="fa fa-save"></i></button>
                </div>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection