@extends('layouts.app')
@section('title','Shto Fature')
@section('bill','active')
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
                <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Shto Fature!</h1>
              </div>
              <form class="user" method="POST" enctype="multipart/form-data" action="{{ route('bill.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label class="text-xs"  for="subject">Subjekti</label>
                    <input value="{{old('subject')}}" type="number "  step="any" min="1" class="form-control form-control-user @error('subject') is-invalid @enderror" name="subject" id="subject"  placeholder="Subjekti">
                    @if ($errors->has('subject'))
                        <span class="help-block"><strong class="text-danger"><small>{{ $errors->first('subject') }}</small></strong></span>
                    @endif
                </div>
                <div class="form-group">
                    <label class="text-xs"  for="bill-nr">Nr i faturës</label>
                    <input value="{{old('bill-nr')}}" type="number "  step="any" min="1" class="form-control form-control-user @error('bill-nr') is-invalid @enderror" name="bill-nr" id="bill-nr"  placeholder="Nr i faturës">
                    @if ($errors->has('bill-nr'))
                        <span class="help-block"><strong class="text-danger"><small>{{ $errors->first('bill-nr') }}</small></strong></span>
                    @endif
                </div>

                <div class="form-group">
                    <label class="text-xs"  for="value">Vlera</label>
                    <input value="{{old('Vlera')}}" type="number "  step="any" min="1" class="form-control form-control-user @error('Vlera') is-invalid @enderror" name="Vlera" id="value"  placeholder="Vlera">
                    @if ($errors->has('Vlera'))
                        <span class="help-block"><strong class="text-danger"><small>{{ $errors->first('Vlera') }}</small></strong></span>
                    @endif
                </div>
          <div class="form-group "> 
            <label class="text-xs"  for="deadline">Afati</label>
            <input value="{{old('Afati')}}"  type="date" class="form-control form-control-user @error('Vlera') is-invalid @enderror" required="" name="Afati" id="deadline" min="{{date('Y-m-d')}}" placeholder="Afati">
            @if ($errors->has('Afati'))
                              <span class="help-block">
                                <strong class="text-danger"><small>{{ $errors->first('Afati') }}</small></strong>
                              </span>
                          @endif
    </div>
    <div class="form-group">
        <label class="text-xs"  for="photo">Foto</label>
      <input id="logo" type="file" class="form-control @error('Foto') is-invalid @enderror" name="Foto" id="photo" placeholder="Fotoja e faturës" >
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