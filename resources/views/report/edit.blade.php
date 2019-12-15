@extends('layouts.app')
@section('title','Reports Edit')
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
              <h1 class="h4 text-gray-900 mb-4">Ndrysho Raport!</h1>
            </div>
            <form class="user" method="POST"action="{{ route('report.update',$report->id) }}">
                {{ method_field('PUT') }}
              {{ csrf_field() }}
              <div class="form-group ">
                <label class="text-xs" for="pacient">Trajtimi</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#treatmentModal"><i class="fa fa-plus"></i> </button>
                    </div>
                <input  placeholder="Trajtimi"  class="form-control form-control-user  " id="treatment" name="treatment"  value="{{App\Treatment::getTreatment($report->treatment_id)}}"/>
                <input  id="treatment-id" value="{{$report->treatment_id}}"  hidden name="treatment-id"/>
                <input  id="pacient-id" value="{{$report->pacient_id}}"  hidden name="pacient-id"/>
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
                          <input type="text" class="form-controller float-right" id="searchTreatment" placeholder="Kërko" name="searchTreatment"/>
                        </div>
                        <div class="modal-body">
                          <table class="table table-bordered table-hover">
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
              @if ($errors->has('treatment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('treatment') }}</strong>
                                </span>
                            @endif
            </div>
              <div class="form-group ">
                        <label class="text-xs"  for="data">Përshkrimi</label>
              <textarea type="text" required class="form-control form-control-user" required="" name="description" id="description"  placeholder="Përshkrimi">{{$report->description}}</textarea>
                        @if ($errors->has('description'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('description') }}</strong>
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