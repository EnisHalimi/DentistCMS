@extends('layouts.app')
@section('title','Treatment Create')
@section('treatment','active')
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <div class="row">
      <div class="col-lg-5 d-none d-lg-block ">
        <img src="https://www.onlinelogomaker.com/blog/wp-content/uploads/2017/09/Dental-Logo-Design.jpg" class="img-fluid" />
      </div>
      <div class="col-lg-7">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Shto Trajtim!</h1>
          </div>
          <form class="user" method="POST" action="{{ route('treatment.store') }}">
            {{ csrf_field() }}
            <div class="form-group ">
              <label class="text-xs" for="pacient">Vizita</label>
              <input  placeholder="Vizita" class="form-control form-control-user" id="visit" name="visit"  data-toggle="modal" data-target="#visitModal" />
              <input  hidden id="visit-id"  name="visit-id"/>
              <div class="modal fade" id="visitModal" tabindex="-1" role="dialog" aria-labelledby="visitModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="visitModalLabel">Zgjedh Vizitën</h5>
                      <input type="text" class="form-controller float-right" id="searchVisit" placeholder="Kërko" name="searchPacient"/>
                    </div>
                    <div class="modal-body">
                      <table class="table table-bordered table-hover">
                        <thead class="bg-dark text-light">
                          <tr>
                            <th scope="col">Emri</th>
                            <th scope="col">Mbiemri</th>
                            <th scope="col">Data</th>
                            <th scope="col">Ora</th>
                            <th scope="col">Shto</th>
                          </tr>
                        </thead>
                        <tbody id="visit-table-body">
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
                    </div>
                  </div>
                </div>
              </div>
              @if ($errors->has('visit-id'))
                <span class="help-block">
                  <strong>{{ $errors->first('visit-id') }}</strong>
                </span>
              @endif
            </div>
            <div class="form-group ">
                    <label class="text-xs"  for="data">Tipi i trajtimit</label>
                <input id="type_of_treatment" name="type_of_treatment" value="{{ old('type_of_treatment') }}" required autofocus type="text" class="form-control form-control-user"  placeholder="Tipi i trajtimit">
                @if ($errors->has('type_of_treatment'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('type_of_treatment') }}</strong>
                                  </span>
                              @endif
            </div>
            <div class="form-group ">
                      <label class="text-xs"  for="data">Kohezgjatjta</label>
                      <input type="text" required class="form-control form-control-user" required="" name="duration" id="duration"  placeholder="Kohezgjatja">
                      @if ($errors->has('duration'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('duration') }}</strong>
                                        </span>
                                    @endif
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