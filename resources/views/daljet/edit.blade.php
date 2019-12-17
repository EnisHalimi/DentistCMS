@extends('layouts.app')
@section('title','Ndrysho Dalje')
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
                <h1 class="h4 text-gray-900 mb-4">Ndrysho Dalje!</h1>
              </div>
              <form class="user" method="POST" enctype="multipart/form-data" action="{{ route('daljet.update',$dalje->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
                <div class="form-group">
                  <label class="text-xs"  for="type">Tipi</label>
                  <select class="form-control form-control-user" name="Tipi" placeholder="Tipi"> 
                    <option>{{$dalje->type}}</option>
                  </select>
                </div>
                <!-- Borgj Type -->
                @if($dalje->type == "Borgj") 
                <div class="form-group"   id="dalje-pacient" >
                    <label class="text-xs" for="pacient">Pacienti</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <button class="btn btn-outline-primary" type="button"  data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
                        </div>
                    <input  placeholder="Pacienti" class="form-control form-control-user" id="pacient" name="pacient" value="{{App\Pacient::getPacient($dalje->pacient_id)}}" />
                    <input  hidden id="pacient-id"   name="pacient-id" value="{{$dalje->pacient_id}}"/>
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
                                        <strong>{{ $errors->first('pacient-id') }}</strong>
                                    </span>
                                @endif
                </div>
                 <!-- Vlera Input -->
                <div class="form-group " id="dalje-value">
                    <label class="text-xs"  for="value">Vlera</label>
                    <input type="text" class="form-control form-control-user" name="Vlera" id="value" value="{{$dalje->value}}"  placeholder="Vlera">
                    @if ($errors->has('Vlera'))
                        <span class="help-block"><strong>{{ $errors->first('Vlera') }}</strong></span>
                    @endif
                </div>
                <!-- Afati Input -->
                <div class="form-group " id="dalje-deadline"> 
                    <label class="text-xs"  for="deadline">Afati</label>
                    <input type="date" class="form-control form-control-user" required="" name="Afati" id="deadline" value="{{$dalje->deadline_date}}" min="{{date('Y-m-d')}}" placeholder="Afati">
                    @if ($errors->has('Afati'))
                        <span class="help-block"><strong>{{ $errors->first('Afati') }}</strong></span>
                    @endif
                </div>
    <input type="text" hidden class="form-control form-control-user" name="Subjekti" id="subject" value="{{$dalje->subject}}" placeholder="Subjekti">
    <input type="text" hidden class="form-control form-control-user" name="Nr_fatures" id="bill_number" value="{{$dalje->bill_number}}" placeholder="Subjekti">
    @else
        <!-- Hidden Inputs -->
        <input type="text" id="pacient-id" name="pacient-id" hidden value="0">
        <!-- Subjekti Inputs -->
        <div class="form-group" id="dalje-subject">
            <label class="text-xs"  for="subject">Subjekti</label>
        <input type="text" class="form-control form-control-user" name="Subjekti" id="subject" value="{{$dalje->subject}}" placeholder="Subjekti">
            @if ($errors->has('Subjekti'))
                <span class="help-block"><strong>{{ $errors->first('Subjekti') }}</strong></span>
            @endif
        </div>
        <!-- NrFatures Inputs -->
        <div class="form-group " id="dalje-billnr">
            <label class="text-xs"  for="bill_number"  >Nr.Faturës</label>
            <input type="text" class="form-control form-control-user" name="Nr_fatures" id="bill_number" value="{{$dalje->bill_number}}"  placeholder="Nr.Faturës">
            @if ($errors->has('Nr_fatures'))
                <span class="help-block"><strong>{{ $errors->first('Nr_fatures') }}</strong></span>
            @endif
        </div>
        <!-- Vlera Input -->
        <div class="form-group " id="dalje-value">
            <label class="text-xs"  for="value">Vlera</label>
            <input type="text" class="form-control form-control-user" name="Vlera" id="value" value="{{$dalje->value}}"  placeholder="Vlera">
            @if ($errors->has('Vlera'))
                <span class="help-block"><strong>{{ $errors->first('Vlera') }}</strong></span>
            @endif
        </div>
        <!-- Afati Input -->
        <div class="form-group " id="dalje-deadline"> 
            <label class="text-xs"  for="deadline">Afati</label>
            <input type="date" class="form-control form-control-user" required="" name="Afati" id="deadline" value="{{$dalje->deadline_date}}" min="{{date('Y-m-d')}}" placeholder="Afati">
            @if ($errors->has('Afati'))
                <span class="help-block"><strong>{{ $errors->first('Afati') }}</strong></span>
            @endif
        </div>
        
        <!-- Photo Input -->
        <div class="form-group " id="dalje-photo">
            <label class="text-xs"  for="photo">Fatura Foto</label>
            <input id="logo" type="file" class="form-control" name="Foto" id="photo" placeholder="Fotoja e faturës" >
            @if ($errors->has('Foto'))
                <span class="help-block"><strong>{{ $errors->first('Foto') }}</strong></span>
            @endif
        </div>
    @endif
                
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