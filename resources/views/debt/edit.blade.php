@extends('layouts.app')
@section('title','Ndrysho Borgj')
@section('debt','active')
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
                <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Ndrysho Borgj!</h1>
              </div>
              <form class="user" method="POST" enctype="multipart/form-data" action="{{ route('debt.update',$debt->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}

                <div class="form-group"   id="debt-pacient" >
                    <label class="text-xs" for="pacient">Pacienti</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
                        </div>
                    <input readonly placeholder="Pacienti" class="form-control form-control-user @error('pacient-id') is-invalid @enderror" id="pacient" name="pacient" value="{{App\Pacient::getPacient($debt->pacient_id)}}" />
                    <input  hidden id="pacient-id"   name="pacient-id" value="{{$debt->pacient_id}}"/>
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
                                        <strong class="text-danger"><small>{{ $errors->first('pacient-id') }}</small></strong>
                                    </span>
                                @endif
                </div>
                 <!-- Vlera Input -->
                <div class="form-group " id="debt-value">
                    <label class="text-xs"  for="value">Vlera</label>
                    <input type="text" class="form-control form-control-user @error('Vlera') is-invalid @enderror" name="Vlera" id="value" value="{{$debt->value}}"  placeholder="Vlera">
                    @if ($errors->has('Vlera'))
                        <span class="help-block"><strong class="text-danger"><small>{{ $errors->first('Vlera') }}</small></strong></span>
                    @endif
                </div>
                <!-- Afati Input -->
                <div class="form-group " id="debt-deadline"> 
                    <label class="text-xs"  for="deadline">Afati</label>
                    <input type="date" class="form-control form-control-user @error('Afati') is-invalid @enderror" required="" name="Afati" id="deadline" value="{{$debt->deadline_date}}" min="{{date('Y-m-d')}}" placeholder="Afati">
                    @if ($errors->has('Afati'))
                        <span class="help-block"><strong class="text-danger"><small>{{ $errors->first('Afati') }}</small></strong></span>
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