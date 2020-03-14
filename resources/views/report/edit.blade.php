@extends('layouts.app')
@section('title','Ndrysho Raport')
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
              <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Ndrysho Raport!</h1>
            </div>
            <form class="user" method="POST"action="{{ route('report.update',$report->id) }}">
                {{ method_field('PUT') }}
              {{ csrf_field() }}
              <div class="form-group ">
                <label class="text-xs" for="pacient">Pacienti</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
                    </div>
                <input readonly value="{{App\Pacient::getPacient($report->pacient_id)}}" placeholder="Pacienti" class="form-control form-control-user @error('pacient-id') is-invalid @enderror" id="pacient" name="pacient"   data-toggle="modal" data-target="#pacientModal" />
                <input  hidden id="pacient-id" value="{{$report->pacient_id}}"  name="pacient-id"/>
                <div class="input-group-append">
                    <button type="button"  class="btn btn-outline-danger" onclick="document.getElementById('pacient').value=''; document.getElementById('pacient-id').value='';" >
                      <i class="fa fa-trash"></i>
                    </button>
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
                <input readonly value="{{App\User::getUser($report->user_id)}}" placeholder="Dentisti" class="form-control form-control-user @error('user-id') is-invalid @enderror" id="user" name="user" data-toggle="modal" data-target="#userModal"  />
                <input  hidden id="user-id"  value="{{$report->user_id}}" name="user-id"/>
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
            <label class="text-xs"  for="complaint">Ankesa</label>
  <textarea type="text"  required class="form-control form-control-user  @error('complaint') is-invalid  @enderror" required="" name="complaint" id="complaint"  placeholder="Ankesa">{{$report->complaint}}</textarea>
            @if ($errors->has('complaint'))
                              <span class="help-block">
                                <strong class="text-danger"><small>{{ $errors->first('complaint') }}</small></strong>
                              </span>
                          @endif
    </div>
    <div class="form-group ">
      <label class="text-xs"  for="evaluation">Vlerësimi i mjekut</label>
<textarea type="text"  required class="form-control form-control-user  @error('evaluation') is-invalid  @enderror" required="" name="evaluation" id="evaluation"  placeholder="Vlerësimi i mjekut">{{$report->evaluation}}</textarea>
      @if ($errors->has('evaluation'))
                        <span class="help-block">
                          <strong class="text-danger"><small>{{ $errors->first('evaluation') }}</small></strong>
                        </span>
                    @endif
</div>
<div class="form-group ">
<label class="text-xs"  for="diagnosis">Diagnoza</label>
<textarea type="text"  required class="form-control form-control-user  @error('diagnosis') is-invalid  @enderror" required="" name="diagnosis" id="diagnosis"  placeholder="Diagnoza">{{$report->diagnosis}}</textarea>
@if ($errors->has('diagnosis'))
                  <span class="help-block">
                    <strong class="text-danger"><small>{{ $errors->first('diagnosis') }}</small></strong>
                  </span>
              @endif
</div>
<div class="form-group ">
<label class="text-xs"  for="recommendation">Rekomandimi</label>
<textarea type="text"  required class="form-control form-control-user  @error('recommendation') is-invalid  @enderror" required="" name="recommendation" id="recommendation"  placeholder="Rekomandimi">{{$report->recommendation}}</textarea>
@if ($errors->has('recommendation'))
              <span class="help-block">
                <strong class="text-danger"><small>{{ $errors->first('recommendation') }}</small></strong>
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