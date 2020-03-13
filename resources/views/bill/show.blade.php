@extends('layouts.app')
@section('title','Shiko Fature')
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
                    <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Të dhënat e faturës</h1>
                </div>
                <table class="table table-striped ">
                        <tbody>
                            <tr>
                                <th>Subjekti:</th>
                                <td scope="row">{{$bill->subject}}</td>
                            </tr>
                            <tr>
                                <th>Nr i faturës:</th>
                                <td scope="row">{{$bill->bill_nr}}</td>
                            </tr>
                            <tr>
                                <th>Vlera:</th>
                                <td scope="row">{{$bill->value}} €</td>
                            </tr>
                            <tr>
                                    <th>Afati:</th>
                                    <td scope="row">{{$bill->deadline}}</td>
                            </tr>
                            <tr>
                                <th>Foto:</th>
                                <td scope="row"><img src="{{asset('img/faturat/'.$bill->file.'')}}" class="img-fluid" /></td></td>
                            </tr>
                        </tbody>
                    </table>
                <hr>
                <a class="btn btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                        <a href="/bill/{{$bill->id}}/edit"  class="btn btn-circle btn-primary"><i class="fa fa-pen"></i></a>
                        <button class="btn btn-circle btn-danger" data-toggle="modal" data-target="#fshijModal{{$bill->id}}"><i class="fa fa-trash"></i></button>
                        <div class="modal fade" id="fshijModal{{$bill->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$bill->id}}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="fshijModalLabel{{$bill->id}}">Fshij Faturen</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        A jeni i sigurtë që doni të vazhdoni?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                        <form class="d-inline" method="POST" action="{{ route('bill.destroy',$bill->id)}}" accept-charset="UTF-8">
                                            {{ csrf_field() }}
                                            <input name="_method" type="hidden" value="DELETE">
                                            <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        </div> 
            </div>
          </div>

         
        </div>
      </div>
    </div>
@endsection