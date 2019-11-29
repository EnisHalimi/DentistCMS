@extends('layouts.app')
@section('title','Kerkimi')
@section('search','border-bottom-dark')
@section('content')

<!-- Begin Page Content -->
<div class="container-fluid mt-4">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-6">
        <h1 class="h3 mb-4 text-gray-800">{{$keyword}} Kërkimi</h1>
      </div>
      <div class="col-sm-6 ">
        </div>
    </div>
    
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista e kërkimit</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Emri Mbiemri</th>
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