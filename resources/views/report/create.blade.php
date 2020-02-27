@extends('layouts.app')
@section('title','Shto Raport')
@section('report','active')
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
              <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Shto Raport!</h1>
            </div>
            <form class="user" method="POST" action="{{ route('report.store') }}">
              {{ csrf_field() }}
              <div class="form-group ">
                <label class="text-xs" for="treatment">Trajtimi</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#treatmentModal"><i class="fa fa-plus"></i> </button>
                    </div>
                    <input  readonly value="{{old('treatment')}}"  placeholder="Trajtimi"  class="form-control form-control-user  @error('treatment-id') is-invalid @enderror " id="treatment" name="treatment"  />
                  <input value="{{old('treatment-id')}}" id="treatment-id" hidden  name="treatment-id"/>
                    <input  value="{{old('pacient-id')}}"  id="pacient-id" hidden  name="pacient-id"/>
                    <div class="input-group-append">
                        <button type="button"  class="btn btn-outline-danger" onclick="document.getElementById('treatment').value=''; document.getElementById('treatment-id').value='';
                        document.getElementById('pacient-id').value='';" >
                          <i class="fa fa-trash"></i>
                        </button>
                      </div>
                </div>
                
                <div class="modal fade" id="treatmentModal" tabindex="-1" role="dialog" aria-labelledby="treatmentModalModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="treatmentModalModalLabel">Zgjedh Trajtimin</h5>
                        </div>
                        <div class="modal-body">
                          <table class="table table-bordered table-hover" width="100%" cellspacing="0"  id="searchTreatment">
                            <thead class="bg-dark text-light">
                              <tr>
                                <th scope="col">Pacienti</th>
                                <th scope="col">Data</th>
                                <th scope="col">Kohezgjatja</th>
                                <th scope="col">Shto</th>
                              </tr>
                            </thead>
                            <tbody id="treatment-table-body">
                            </tbody>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
                        </div>
                      </div>
                    </div>
                  </div>
              @if ($errors->has('treatment-id'))
                                <span class="help-block">
                                    <strong class="text-danger"><small>{{ $errors->first('treatment-id') }}</small></strong>
                                </span>
              @endif
            </div>
              <div class="form-group ">
                        <label class="text-xs"  for="description">Përshkrimi</label>
              <textarea type="text"  required class="form-control form-control-user  @error('Pershkrimi') is-invalid  @enderror" required="" name="Pershkrimi" id="description"  placeholder="Përshkrimi">{{old('Pershkrimi')}}</textarea>
                        @if ($errors->has('Pershkrimi'))
                                          <span class="help-block">
                                            <strong class="text-danger"><small>{{ $errors->first('Pershkrimi') }}</small></strong>
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