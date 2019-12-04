@extends('layouts.app')
@section('title','Treatment Edit')
@section('treatment','active')
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <div class="row">
      <div class="col-lg-5 d-flex justify-content-center ">
        <img src="{{App\User::getLogo()}}" class="img-fluid" />
      </div>
      <div class="col-lg-7">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 text-gray-900 mb-4">Ndrysho Trajtim!</h1>
          </div>
          <form class="user" method="POST" action="{{ route('treatment.update',$treatment->id) }}">
                {{ method_field('PUT') }}
            {{ csrf_field() }}
            <div class="form-group ">
                <label class="text-xs" for="pacient">Pacienti</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
                    </div>
                  <input  placeholder="Pacienti"  class="form-control form-control-user  " id="pacient" name="pacient"  value="{{App\Pacient::getPacient($treatment->pacient_id)}}"/>
                    <input  hidden id="pacient-id" value="{{$treatment->pacient_id}}"  name="pacient-id"/>
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
              @if ($errors->has('pacient'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('pacient') }}</strong>
                                </span>
                            @endif
            </div>
              <div class="form-group ">
                      <label class="text-xs"  for="starting_date">Data e fillimit</label>
              <input id="starting_date" value="{{$treatment->starting_date}}" name="starting_date" value="{{ old('starting_date') }}" required autofocus type="date" class="form-control form-control-user"  placeholder="Data e fillimit">
                  @if ($errors->has('starting_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('starting_date') }}</strong>
                                    </span>
                                @endif
              </div>
              <div class="form-group ">
                        <label class="text-xs"  for="data">Kohezgjatjta</label>
              <input type="text" value="{{$treatment->duration}}" required class="form-control form-control-user" required="" name="duration" id="duration"  placeholder="Kohezgjatja">
                        @if ($errors->has('duration'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('duration') }}</strong>
                                          </span>
                                      @endif
                </div>
  
                <div class="form-group mb-3">
                    <label class="text-xs" for="services">Shërbimet</label>
                    <div class="input-group mb-3">
                  <div class="input-group-prepend">
                      <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#serviceModal"><i class="fa fa-plus"></i> </button>
                    </div>
                    <input hidden  id="service-list" value="@foreach($services as $service){{$service->id}},@endforeach"
                    name="service-list"/>
                  <select  multiple placeholder="Shërbimet" class="form-control form-control-user" id="services" name="services" >
                    @foreach ($services as $service)
                      <option>{{$service->name}}</option>
                    @endforeach
                    </select>
                    <div class="input-group-append">
                        <button type="button" class="btn btn-outline-danger" onclick="
                          document.getElementById('service-list').value='';
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
                            <input type="text" class="form-controller float-right" id="searchService" placeholder="Kërko" name="searchService"/>
                          </div>
                          <div class="modal-body">
                            <table class="table table-bordered table-hover">
                              <thead class="bg-dark text-light">
                                <tr>
                                  <th scope="col">Shërbimi</th>
                                  <th scope="col">Qmimi</th>
                                  <th scope="col">Zbritja</th>
                                  <th scope="col">Shto</th>
                                </tr>
                              </thead>
                              <tbody id="service-table-body">
                              </tbody>
                            </table>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
                          </div>
                        </div>
                      </div>
                    </div>
                @if ($errors->has('services'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('services') }}</strong>
                                  </span>
                @endif
               
              </div>   <div class="form-group">
                <a class="btn btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                  <button type="submit"  class="btn btn-circle btn-primary float-right"><i class="fa fa-pen"></i></button>
                </div>
            </form>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection