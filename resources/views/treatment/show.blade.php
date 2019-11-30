@extends('layouts.app')
@section('title','Treatment View')
@section('treatment','active')
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
              <h1 class="h4 text-gray-900 mb-4">Të dhënat e trajtimit</h1>
            </div>
            <table class="table table-striped ">
                    <tbody>
                        <tr>
                            <th>Vizita:</th>
                            <td scope="row"><a class="btn btn-circle btn-secondary btn-sm" href="/visit/{{$treatment->visit_id}}"><i class="fa fa-eye"></i></a> {{App\Visit::getVisitPacientName($treatment->visit_id)}}</td>
                        </tr>
                       
                        <tr>
                            <th>Trajtimi</th>
                            <td scope="row">{{$treatment->type_of_treatment}}</td>
                        </tr>
                        <tr>
                                <th>Kohëzgjatja:</th>
                                <td scope="row">{{$treatment->duration}} </td>
                            </tr>
                        </tbody>
                </table>
               
            <hr>
            <a class="btn btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i> Kthehu</a>
                    <a href="/treatment/{{$treatment->id}}/edit"  class="btn btn-info"><i class="fa fa-pen"></i> Ndrysho</a>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#fshijModal{{$treatment->id}}"><i class="fa fa-trash"></i> Fshij</button>
                    <div class="modal fade" id="fshijModal{{$treatment->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$treatment->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="fshijModalLabel{{$treatment->id}}">Fshij Vizitën</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    A jeni i sigurtë që doni të vazhdoni?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                                    <form class="d-inline" method="POST" action="{{ route('treatment.destroy',$treatment->id)}}" accept-charset="UTF-8">
                                        {{ csrf_field() }}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Fshij</button>
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