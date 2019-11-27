@extends('layouts.app')
@section('title','Visit')
@section('visit','active')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid mt-4">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-sm-6">
            <h1 class="h3 mb-4 text-gray-800">Vizitat</h1>
          </div>
          <div class="col-sm-6 ">
              <a href="/visit/create" class="btn btn-success float-right"><i class="fa fa-plus"></i> Krijo</a>
            </div>
        </div>
        
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e vizitave</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Pacienti</th>
                    <th>Dentisti</th>
                    <th>Data</th>
                    <th>Ora</th>
                    <th>Menaxhimi</th>
                  </tr>
                </thead>
                <tbody>
                  @if(count($visits) > 0)
                  @foreach($visits as $visit)
                  <tr>
                        <td>  <a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$visit->pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($visit->pacient_id)}}</td>
                        <td> <a class="btn btn-circle btn-secondary btn-sm" href="/user/{{$visit->user_id}}"><i class="fa fa-user-md"></i></a> {{App\User::getUser($visit->user_id)}}</td>
                        <td>{{$visit->date_of_visit}}</td>
                        <td>{{$visit->time_of_visit}}</td>
                        <td>
                          <a href="/visit/{{$visit->id}}" class="btn btn-secondary"><i class="fa fa-eye"></i> Shiko</a>
                          <a href="/visit/{{$visit->id}}/edit"  class="btn btn-info"><i class="fa fa-pen"></i> Ndrysho</a>
                          <button class="btn btn-danger" data-toggle="modal" data-target="#fshijModal{{$visit->id}}"><i class="fa fa-trash"></i> Fshij</button>
                          <div class="modal fade" id="fshijModal{{$visit->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$visit->id}}" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="fshijModalLabel{{$visit->id}}">Fshij Vizitën</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          A jeni i sigurtë që doni të vazhdoni?
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                                          <form class="d-inline" method="POST" action="{{ route('visit.destroy',$visit->id)}}" accept-charset="UTF-8">
                                              {{ csrf_field() }}
                                              <input name="_method" type="hidden" value="DELETE">
                                              <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Fshij</button>
                                          </form>
                                          
                                      </div>
                                  </div>
                              </div>
                          </div> 
                        </td>
                    
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="4">Nuk u gjetën vizita</td>
                  </tr>
                  @endif
                </tbody>
              </table>
              {{ $visits->appends(request()->query())->links() }}
            </div>
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
@endsection