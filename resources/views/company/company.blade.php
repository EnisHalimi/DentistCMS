@extends('layouts.app')
@section('title','Kompania')
@section('settings','active')
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
            <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Ndrysho Kompanine!</h1>
          </div>
          <form class="user" method="POST"  enctype="multipart/form-data" action="{{ url('/company/save') }}">
            {{ csrf_field() }}
            <div class="form-group ">
              <label class="text-xs" for="name">Emri i Ordinancës</label>
              <input id="name" name="name" value="{{$company->name}}" required type="text" class="form-control form-control-user @error('name') is-invalid @enderror"  placeholder="Emri i Ordinancës">
                            
                            @if ($errors->has('name'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
          </div>
          <div class="form-group ">
            <label class="text-xs" for="nr_fiscal">Numri Fiskal</label>
            <input id="nr_fiscal" name="nr_fiscal" value="{{$company->nr_fiscal}}"  type="text" class="form-control form-control-user @error('nr_fiscal') is-invalid @enderror"  placeholder="Numri Fiskal">
                          
                          @if ($errors->has('nr_fiscal'))
                                          <span class="help-block">
                                              <strong>{{ $errors->first('nr_fiscal') }}</strong>
                                          </span>
                                      @endif
        </div>
        <div class="form-group ">
          <label class="text-xs" for="nr_business">Numri Biznesit</label>
          <input id="nr_business" name="nr_business" value="{{$company->nr_business}}"  type="text" class="form-control form-control-user @error('nr_business') is-invalid @enderror"  placeholder="Numri Biznesit">
                        @if ($errors->has('nr_business'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('nr_business') }}</strong>
                                        </span>
                                    @endif
      </div>
      <div class="form-group ">
        <label class="text-xs" for="nr_tax">Numri Tatimor</label>
        <input id="nr_tax" name="nr_tax" value="{{$company->nr_tax}}"  type="text" class="form-control form-control-user @error('nr_tax') is-invalid @enderror"  placeholder="Numri Tatimor">
                      
                      @if ($errors->has('nr_tax'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('nr_tax') }}</strong>
                                      </span>
                                  @endif
    </div>
    <div class="form-group ">
      <label class="text-xs" for="tvsh">TVSH</label>
      <input id="tvsh" name="tvsh" value="{{$company->tvsh}}" required type="text" class="form-control form-control-user @error('tvsh') is-invalid @enderror"  placeholder="TVSH">
                    
                    @if ($errors->has('tvsh'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tvsh') }}</strong>
                                    </span>
                                @endif
  </div>
  <div class="form-group ">
    <label class="text-xs" for="phone">Telefoni</label>
    <input id="phone" name="phone" value="{{$company->phone}}" required type="text" class="form-control form-control-user @error('phone') is-invalid @enderror"  placeholder="Telefoni">
                  
                  @if ($errors->has('phone'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('phone') }}</strong>
                                  </span>
                              @endif
</div>
<div class="form-group ">
  <label class="text-xs" for="email">E-Mail</label>
  <input id="email" name="email" value="{{$company->email}}"  type="email" class="form-control form-control-user @error('email') is-invalid @enderror"  placeholder="E-Mail">
                
                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
</div>
<div class="form-group ">
  <label class="text-xs" for="adress">Adresa</label>
  <input id="adress" name="adress" value="{{$company->adress}}" required type="text" class="form-control form-control-user @error('adress') is-invalid @enderror"  placeholder="Adresa">
                
                @if ($errors->has('adress'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('adress') }}</strong>
                                </span>
                            @endif
</div>
<div class="form-group ">
  <label class="text-xs" for="city">Qyteti</label>
  <input id="city" name="city" value="{{$company->city}}" required type="text" class="form-control form-control-user @error('city') is-invalid @enderror"  placeholder="Qyteti">
                
                @if ($errors->has('city'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city') }}</strong>
                                </span>
                            @endif
</div>
<div class="form-group row">
  <div class="col-sm-4 mb-3 mb-sm-0">
    <label class="text-xs"  for="account_1">Llogaria 1</label>
  <input id="account_1" name="account_1" type="text" value="{{$company->account_1}}" class="form-control form-control-user  @error('account_1') is-invalid @enderror"   placeholder="Llogaria 1">
                
                @if ($errors->has('account_1'))
                                <span class="help-block">
                                    <strong class="text-danger"><small>{{ $errors->first('account_1') }}</small></strong>
                                </span>
                            @endif
              </div>
              <div class="col-sm-4 mb-3 mb-sm-0">
                <label class="text-xs"  for="account_2">Llogaria 2</label>
                      <input id="account_2" name="account_2"  value="{{$company->account_2}}"   type="text" class="form-control form-control-user @error('account_2') is-invalid @enderror"  placeholder="Llogaria 2">
                      @if ($errors->has('account_2'))
                                <span class="help-block">
                                    <strong class="text-danger"><small>{{ $errors->first('account_2') }}</small></strong>
                                </span>
                            @endif
                    </div>
              <div class="col-sm-4">
                <label class="text-xs"  for="account_3">Llogaria 3</label>
                <input id="account_3" name="account_3"  type="text"  value="{{$company->account_3}}" class="form-control form-control-user @error('account_3') is-invalid @enderror" placeholder="Llogaria 3">
                @if ($errors->has('account_3'))
                                <span class="help-block">
                                    <strong class="text-danger"><small>{{ $errors->first('account_3') }}</small></strong>
                                </span>
                            @endif
              </div>
</div>
            <div class="form-group ">
              <label class="text-xs"  for="data">Logoja</label>
            <input id="logo" type="file" class="form-control" name="logo" placeholder="{{$company->logo}}" >
                      @if ($errors->has('logo'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('logo') }}</strong>
                                        </span>
                                    @endif
              </div>
              <div class="form-group ">
                  <label class="text-xs"  for="data">Tema</label>
              <select class="form-control form-control-user" id="theme" name="theme" placeholder="Tema">
                  <option @if($company->theme == false) selected @else @endif value="0">E ndriquar</option>
                  <option @if($company->theme == true) selected @else @endif value="1">E errët</option>
              </select>
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