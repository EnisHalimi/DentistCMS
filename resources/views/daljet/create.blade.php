@extends('layouts.app')
@section('title','Regjistro Dalje')
@section('daljet','active')
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
                <h1 class="h4 text-gray-900 mb-4">Shto Dalje!</h1>
              </div>
              <form class="user" method="POST" enctype="multipart/form-data" action="{{ route('daljet.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="text-xs"  for="type">Tipi</label>
                  <select class="form-control form-control-user" id="type" name="Tipi" placeholder="Tipi"> 
                    <option>Faturë</option>
                    <option>Borgj</option>
                  </select>
                </div>
                <div class="form-group"   id="dalje-pacient">
                    <label class="text-xs" for="pacient">Pacienti</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
                        </div>
                    <input  placeholder="Pacienti" class="form-control form-control-user" id="pacient" name="pacient"  />
                    <input  hidden id="pacient-id"  value="0" name="pacient-id"/>
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
                              <input type="text" class="form-controller float-right" id="searchPacient" placeholder="Kërko" name="searchPacient"/>
                            </div>
                            <div class="modal-body">
                              <table class="table table-bordered table-hover">
                                <thead class="bg-dark text-light">
                                  <tr>
                                    <th scope="col">Emri</th>
                                    <th scope="col">Mbiemri</th>
                                    <th scope="col">Numri Personal</th>
                                    <th scope="col">Shto</th>
                                  </tr>
                                </thead>
                                <tbody id="pacient-table-body">
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
                                        <strong>{{ $errors->first('pacient-id') }}</strong>
                                    </span>
                                @endif
                </div>
                <div class="form-group" id="dalje-subject">
                        <label class="text-xs"  for="subject">Subjekti</label>
                        <input type="text" class="form-control form-control-user" name="Subjekti" id="subject"  placeholder="Subjekti">
                        @if ($errors->has('Subjekti'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('Subjekti') }}</strong>
                                          </span>
                                      @endif
                </div>
                <div class="form-group " id="dalje-billnr">
                  <label class="text-xs"  for="bill_number"  >Nr.Faturës</label>
                  <input type="text" class="form-control form-control-user" name="Nr_fatures" id="bill_number"  placeholder="Nr.Faturës">
                  @if ($errors->has('Nr_fatures'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Nr_fatures') }}</strong>
                                    </span>
                                @endif
          </div>
                <div class="form-group ">
                  <label class="text-xs"  for="value">Vlera</label>
                  <input type="text" class="form-control form-control-user" name="Vlera" id="value"  placeholder="Vlera">
                  @if ($errors->has('Vlera'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('Vlera') }}</strong>
                                    </span>
                                @endif
          </div>
          <div class="form-group ">
            <label class="text-xs"  for="deadline">Afati</label>
            <input type="date" class="form-control form-control-user" required="" name="Afati" id="deadline" min="{{date('Y-m-d')}}" placeholder="Afati">
            @if ($errors->has('Afati'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('Afati') }}</strong>
                              </span>
                          @endif
    </div>
    <div class="form-group " id="dalje-photo">
    <label class="text-xs"  for="photo">Fatura Foto</label>
  <input id="logo" type="file" class="form-control" name="Foto" id="photo" placeholder="Fotoja e faturës" >
            @if ($errors->has('Foto'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('Foto') }}</strong>
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