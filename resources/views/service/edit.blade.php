@extends('layouts.app')
@section('title','Ndrysho Sherbim')
@section('service','active')
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
              <h1 class="h4 text-gray-900 mb-4">Ndrysho Shërbim!</h1>
            </div>
            <form class="user" method="POST" action="{{ route('services.update',$service->id) }}">
                {{ method_field('PUT') }}
                {{ csrf_field() }}
              <div class="form-group ">
                    <label class="text-xs"  for="name">Shërbimi</label>
              <input id="name" name="Sherbimi" required autofocus type="text" class="form-control form-control-user @error('Sherbimi') is-invalid @enderror"  placeholder="Shërbimi" value="{{$service->name}}">
              @if ($errors->has('Sherbimi'))
              <span class="help-block">
                  <strong class="text-danger"> <small>{{ $errors->first('Sherbimi') }}</small></strong>
              </span>
          @endif
              </div>
              <div class="form-group">
                    <label class="text-xs"  for="price">Qmimi</label>
                <input  id="price" name="Qmimi" step="any"  required min="1" type="number" class="form-control form-control-user @error('Qmimi') is-invalid @enderror" placeholder="Qmimi" value="{{$service->price}}">
                @if ($errors->has('Qmimi'))
                <span class="help-block">
                  <strong class="text-danger"> <small>{{ $errors->first('Qmimi') }}</small></strong>
                </span>
            @endif
              </div>
              <div class="form-group">
                    <label class="text-xs"  for="discount">Zbritja</label>
                <input  id="discount" value="{{$service->discount}}" onchange="document.getElementById('discount-text').innerHTML = this.value + ' %';" name="discount"  required type="range" class="form-control form-control-user @error('discount') is-invalid @enderror" min="0" max="100" class="slider"  placeholder="Zbritja">
                <span id='discount-text'>{{$service->discount}} %</span>
                @if ($errors->has('discount'))
                <span class="help-block">
                  <strong class="text-danger"> <small>{{ $errors->first('discount') }}</small></strong>
                </span>
            @endif
              </div>
              <div class="form-group">
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
