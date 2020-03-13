@extends('layouts.app')
@section('title','Shto Trajtim')
@section('treatment','active')
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
            <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Shto Trajtim!</h1>
          </div>
          <form class="user"  enctype="multipart/form-data" method="POST" action="{{ route('treatment.store') }}">
            {{ csrf_field() }}
            <div class="form-group ">
              <label class="text-xs" for="pacient">Pacienti</label>
              <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
                  </div>
                  <input readonly placeholder="Pacienti"  value="{{ old('pacient') }}" class="form-control form-control-user @error('pacient-id') is-invalid @enderror " id="pacient" name="pacient"  />
                  <input  hidden id="pacient-id"   value="{{ old('pacient-id') }}" name="pacient-id"/>
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
                    <label class="text-xs"  for="starting_date">Data e fillimit</label>
                <input id="starting_date" name="Data_e_fillimit" value="{{ old('Data_e_fillimit') }}" required autofocus type="date" class="form-control form-control-user @error('Data_e_fillimit') is-invalid @enderror "  placeholder="Data e fillimit">
                @if ($errors->has('Data_e_fillimit'))
                                  <span class="help-block">
                                    <strong class="text-danger"><small>{{ $errors->first('Data_e_fillimit') }}</small></strong>
                                  </span>
                              @endif
            </div>
            <div class="form-group ">
                      <label class="text-xs"  for="duration">Kohezgjatjta</label>
            <input type="text" required class="form-control form-control-user @error('Kohezgjatja') is-invalid @enderror" required="" value="{{old('Kohezgjatja')}}" name="Kohezgjatja" id="duration"  placeholder="Kohezgjatja">
                      @if ($errors->has('Kohezgjatja'))
                                        <span class="help-block">
                                          <strong class="text-danger"><small>{{ $errors->first('Kohezgjatja') }}</small></strong>
                                        </span>
                                    @endif
              </div>

              <div class="form-group mb-3">
                  <label class="text-xs" for="services">Shërbimet</label>
                  <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#serviceModal"><i class="fa fa-plus"></i> </button>
                  </div>
                  <input  hidden id="service-list"  name="Sherbimet"/>
                <select readonly  multiple placeholder="Shërbimet" class="form-control form-control-user @error('Sherbimet') is-invalid @enderror" id="services" name="services" >
                  </select>
                  <div class="input-group-append">
                      <button type="button" class="btn btn-outline-danger" onclick=" document.getElementById('service-list').value='';
                      document.getElementById('services').options.length = 0;" >
                        <i class="fa fa-trash"></i>
                      </button>
                    </div>
                  </div>
                <div class="modal fade" id="serviceModal" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="serviceModalLabel">Zgjedh Shërbimin</h5>
                        </div>
                        <div class="modal-body">
                          <table class="table table-bordered table-hover" id="searchService"  width="100%" cellspacing="0" >
                            <thead class="bg-dark text-light">
                              <tr>
                                <th scope="col">Shërbimi</th>
                                <th scope="col">Qmimi</th>
                                <th scope="col">Zbritja</th>
                                <th scope="col">Shto</th>
                              </tr>
                            </thead>
                            <tbody >
                            </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
                        </div>
                      </div>
                    </div>
                  </div>
              @if ($errors->has('Sherbimet'))
                                <span class="help-block">
                                  <strong class="text-danger"><small>{{ $errors->first('Sherbimet') }}</small></strong>
                                </span>
              @endif
             
            </div>

            <div class="form-group">
              <label class="text-xs"  for="photo">Grafia</label>
            <input id="logo" type="file" class="form-control @error('Foto') is-invalid @enderror" name="Foto" id="photo" placeholder="Fotoja e grafisë" >
                      @if ($errors->has('Foto'))
                                        <span class="help-block">
                                          <strong class="text-danger"><small>{{ $errors->first('Foto') }}</small></strong>
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