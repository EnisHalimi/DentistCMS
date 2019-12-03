@extends('layouts.app')
@section('title','Service Edit')
@section('service','active')
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
      <!-- Nested Row within Card Body -->
      <div class="row">
        <div class="col-lg-5 d-none d-lg-block ">
        <img src="https://www.onlinelogomaker.com/blog/wp-content/uploads/2017/09/Dental-Logo-Design.jpg" class="img-fluid" />
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
              <input id="name" name="name" required autofocus type="text" class="form-control form-control-user"  placeholder="Shërbimi" value="{{$service->name}}">
                @if ($errors->has('name'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                              @endif
              </div>
              <div class="form-group">
                    <label class="text-xs"  for="price">Qmimi</label>
                <input  id="price" name="price" step="any"  required type="number" class="form-control form-control-user" placeholder="Qmimi" value="{{$service->price}}">
                @if ($errors->has('price'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('price') }}</strong>
                                  </span>
                              @endif
              </div>
              <div class="form-group">
                    <label class="text-xs"  for="discount">Zbritja</label>
                <input  id="discount" value="{{$service->discount}}" onchange="document.getElementById('discount-text').innerHTML = this.value + ' %';" name="discount"  required type="range" class="form-control form-control-user" min="0" max="100" class="slider"  placeholder="Zbritja">
                <span id='discount-text'>{{$service->discount}} %</span>
                @if ($errors->has('discount'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('discount') }}</strong>
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
