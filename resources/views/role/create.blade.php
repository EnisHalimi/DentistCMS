@extends('layouts.app')
@section('title','Shto Role')
@section('settings','active')
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
                <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Shto Role!</h1>
              </div>
              
        <form id="add_role" class="user" method="POST" action="{{ route('role.store') }}">
            {{ csrf_field() }}
    <div class="form-group ">
      <label class="text-xs "  for="name">Emri</label>
      <input id="name" name="name" value="{{ old('name') }}" required autofocus type="text" class="form-control form-control-user @error('name') is-invalid @enderror"  placeholder="Emri">
      @if ($errors->has('name'))
                        <span class="help-block">
                            <strong class="text-danger"><small>{{ $errors->first('name') }}</small></strong>
                        </span>
                    @endif
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Pacient</label>
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-pacient">Shiko</label>
        <input  type="checkbox" name="permission[]" value="1" id="view-pacient"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-pacient">Krijo</label>
        <input  type="checkbox" name="permission[]" value="2" id="create-pacient"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-pacient">Ndrysho</label>
        <input   type="checkbox" name="permission[]"value="3" id="edit-pacient"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-pacient">Fshij</label>
        <input type="checkbox" name="permission[]"  value="4" id="delete-pacient"></div>
      </div>
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Termine</label>
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-appointment">Shiko</label>
        <input type="checkbox" name="permission[]" value="5" id="view-appointment"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-appointment">Krijo</label>
        <input  type="checkbox" name="permission[]" value="6" id="create-appointment"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-appointment">Ndrysho</label>
        <input   type="checkbox" name="permission[]" value="7" id="edit-appointment"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-appointment">Fshij</label>
        <input   type="checkbox" name="permission[]" value="8" id="delete-appointment"></div>
      </div>
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Vizita</label>
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-visit">Shiko</label>
        <input   type="checkbox" name="permission[]" value="9" id="view-visit"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-visit">Krijo</label>
        <input   type="checkbox" name="permission[]" value="10" id="create-visit"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-visit">Ndrysho</label>
        <input type="checkbox" name="permission[]" value="11" id="edit-visit"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-visit">Fshij</label>
        <input   type="checkbox" name="permission[]" value="12" id="delete-visit"></div>
      </div>
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Trajtime</label>
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-treatment">Shiko</label>
        <input   type="checkbox" name="permission[]" value="13" id="view-treatment"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-treatment">Krijo</label>
        <input   type="checkbox" name="permission[]" value="14" id="create-treatment"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-treatment">Ndrysho</label>
        <input   type="checkbox" name="permission[]" value="15" id="edit-treatment"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-treatment">Fshij</label>
        <input   type="checkbox" name="permission[]" value="16" id="delete-treatment"></div>
      </div>
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Raporte</label>
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-report">Shiko</label>
        <input   type="checkbox" name="permission[]" value="17" id="view-report"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-report">Krijo</label>
        <input   type="checkbox" name="permission[]" value="18" id="create-report"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-report">Ndrysho</label>
        <input   type="checkbox" name="permission[]" value="19" id="edit-report"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-report">Fshij</label>
        <input   type="checkbox" name="permission[]" value="20" id="delete-report"></div>
      </div>
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Sherbimet</label>
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-services">Shiko</label>
        <input   type="checkbox" name="permission[]" value="21" id="view-services"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-services">Krijo</label>
        <input   type="checkbox" name="permission[]" value="22" id="create-services"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-services">Ndrysho</label>
        <input   type="checkbox" name="permission[]" value="23" id="edit-services"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-services">Fshij</label>
        <input   type="checkbox" name="permission[]" value="24" id="delete-services"></div>
      </div>
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Perdoruesit</label>
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-user">Shiko</label>
        <input   type="checkbox" name="permission[]" value="25" id="view-user"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-user">Krijo</label>
        <input   type="checkbox" name="permission[]" value="26" id="create-user"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-user">Ndrysho</label>
        <input   type="checkbox" name="permission[]" value="27" id="edit-user"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-user">Fshij</label>
        <input   type="checkbox" name="permission[]" value="28" id="delete-user"></div>
      </div>
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Rolet</label>
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-role">Shiko</label>
        <input   type="checkbox" name="permission[]" value="29" id="view-role"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-role">Krijo</label>
        <input   type="checkbox" name="permission[]" value="30" id="create-role"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-role">Ndrysho</label>
        <input   type="checkbox" name="permission[]" value="31" id="edit-role"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-role">Fshij</label>
        <input   type="checkbox" name="permission[]" value="32" id="delete-role"></div>
      </div>
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Borgjet</label>
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-debt">Shiko</label>
        <input   type="checkbox" name="permission[]" value="33" id="view-debt"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-debt">Krijo</label>
        <input   type="checkbox" name="permission[]" value="34" id="create-debt"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-debt">Ndrysho</label>
        <input   type="checkbox" name="permission[]" value="35" id="edit-debt"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-debt">Fshij</label>
        <input   type="checkbox" name="permission[]" value="36" id="delete-debt"></div>
      </div>
    </div>
    <div class="form-group ">
      <label class="text-xs font-weight-bold"  >Shpenzimet</label> 
      <div class="row">
      <div class="col-sm-3"><label class="text-xs "  for="view-bill">Shiko</label>
        <input   type="checkbox" name="permission[]" value="37" id="view-bill"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="create-bill">Krijo</label>
        <input   type="checkbox" name="permission[]" value="38" id="create-bill"></div>
      <div class="col-sm-3">  <label class="text-xs "  for="edit-bill">Ndrysho</label>
        <input   type="checkbox" name="permission[]" value="39" id="edit-bill"></div>
      <div class="col-sm-3"> <label class="text-xs "  for="delete-bill">Fshij</label>
        <input   type="checkbox" name="permission[]" value="40" id="delete-bill"></div>
      </div>
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