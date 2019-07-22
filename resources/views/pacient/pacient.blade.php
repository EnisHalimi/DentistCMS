@extends('layouts.app')
@section('title', 'Pacient')
@section('pacient','active')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

  <!-- Page Heading -->
  <div class="row">
    <div class="col-sm-6">
      <h1 class="h3 mb-4 text-gray-800">Pacientët</h1>
    </div>
    <div class="col-sm-6 ">
        <a href="/pacient/create" class="btn btn-success float-right"><i class="fa fa-plus"></i> Krijo</a>
      </div>
  </div>
  
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Lista e pacientëve</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Pacienti</th>
              <th>Numri Personal</th>
              <th>Data e lindjes</th>
              <th>Adresa</th>
              <th>Menaxhimi</th>
            </tr>
          </thead>
          <tbody>
            @if(count($pacients) > 0)
            @foreach($pacients as $pacient)
            <tr>
              <td>{{$pacient->first_name}} {{$pacient->last_name}}</td>
              <td>{{$pacient->personal_number}}</td>
              <td>{{$pacient->date_of_birth}}</td>
              <td>{{$pacient->address}}</td>
              <td>
                <a href="/pacient/{{$pacient->id}}" class="btn btn-secondary"><i class="fa fa-eye"></i> Shiko</a>
                <a href="/pacient/{{$pacient->id}}/edit"  class="btn btn-info"><i class="fa fa-pen"></i> Ndrysho</a>
                <button class="btn btn-danger" data-toggle="modal" data-target="#fshijModal{{$pacient->id}}"><i class="fa fa-trash"></i> Fshij</button>
                <div class="modal fade" id="fshijModal{{$pacient->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$pacient->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fshijModalLabel{{$pacient->id}}">A jeni i sigurtë që doni të fshini Pacientin?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                
                                <form class="d-inline" method="POST" action="{{ route('pacient.destroy',$pacient->id,)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <div class="custom-control custom-checkbox small">
                                        <input type="checkbox"  name="data"  class="custom-control-input" id="data">
                                    <label class="custom-control-label" for="data">Fshini të dhënat e Pacientit?</label>
                                      </div>
                                   
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                               
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
              <td colspan="5">Nuk u gjetën pacientë</td>
            </tr>
            @endif
          </tbody>
        </table>
        {{ $pacients->appends(request()->query())->links() }}
      </div>
    </div>
  </div>

</div>
@endsection