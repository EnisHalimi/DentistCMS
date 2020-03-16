@extends('layouts.app')
@section('title','Terminet')
@section('appointment','active')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid mt-4">

  <!-- Page Heading -->
  <div class="row">
    <div class="col-sm-6">
      <h1 class="h3 mb-4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-800 @endif">Terminet</h1>
    </div>
    <div class="col-sm-6 ">
      <button type="button" class="btn btn-circle btn-success float-right"  data-toggle="modal" data-target="#exampleModal">
        <i class="fa fa-plus"></i>
      </button>
      </div>
  </div>
  
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista e Termineve</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="AppointmentdataTable" width="100%" cellspacing="0">
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
            
          </tbody>
        </table>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->  

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Shto Termin</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
        <form class="user" method="POST" action="{{ route('appointment.store') }}">
          {{ csrf_field() }}
  <div class="form-group ">
      <label class="text-xs" for="pacient">Pacienti</label>
      <div class="input-group mb-3">
          <div class="input-group-prepend">
              <button class="btn btn-outline-primary" type="button" id="create-termin-button" data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
          </div>
      <input  placeholder="Pacienti" readonly class="form-control form-control-user @error('pacient-id') is-invalid @enderror" id="pacient" name="pacient"   value="{{ old('pacient') }}" />
      <input  hidden id="pacient-id"  name="pacient-id"  value="{{ old('pacient-id') }}"/>
      <div class="input-group-append">
          <button type="button"  class="btn btn-outline-danger" onclick="document.getElementById('pacient').value=''; document.getElementById('pacient-id').value='';" >
            <i class="fa fa-trash"></i>
          </button>
        </div>
  </div>
      <div class="modal fade" id="pacientModal" tabindex="-1"  role="dialog" aria-labelledby="pacientModalLabel" aria-hidden="true">
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
          <input  placeholder="Dentisti" readonly  value="{{ old('user') }}" class="form-control form-control-user @error('user-id') is-invalid @enderror" id="user" name="user"   />
          <input  hidden id="user-id"   value="{{ old('user-id') }}" name="user-id"/>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" data-target="#userModal">Mbylle</button>
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
          <input type="date"  value="{{ old('data') }}" class="form-control form-control-user @error('data') is-invalid @enderror" required="" name="data" id="data" min="{{date('Y-m-d',strtotime('tomorrow'))}}" placeholder="Data e Terminit">
          @if ($errors->has('data'))
                            <span class="help-block">
                              <strong class="text-danger"><small>{{ $errors->first('data') }}</small></strong>
                            </span>
                        @endif
  </div>
  
  <div class="form-group">
          <label class="text-xs"  for="time">Ora e Terminit</label>
          <select class="form-control form-control-user @error('time') is-invalid @enderror" id="time" name="time" placeholder="Ora"> 
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
            <strong class="text-danger"><small>{{ $errors->first('time') }}</small></strong>
          </span>
      @endif
        </div>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-chevron-left"></i></button>
        <button type="submit"  class="btn btn-circle btn-primary float-right"><i class="fa fa-save"></i></button>
      </div>
    </div>
  </div>
</div>
@endsection