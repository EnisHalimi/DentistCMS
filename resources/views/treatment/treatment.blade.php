@extends('layouts.app')
@section('title','Treatment')
@section('treatment','active')
@section('content')
  <!-- Begin Page Content -->
  <div class="container-fluid mt-4">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-6">
        <h1 class="h3 mb-4 text-gray-800">Trajtimet</h1>
      </div>
      <div class="col-sm-6 ">
          <a href="/treatment/create" class="btn btn-success float-right"><i class="fa fa-plus"></i> Krijo</a>
        </div>
    </div>
    
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista e trajtimeve</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="TreatmentdataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Vizita</th>
                <th>Trajtimi</th>
                <th>Kohëzgjatja</th>
                <th>Menaxhimi</th>
              </tr>
            </thead>
            <tbody>
              
            </tbody>
          </table>
        </div>
      </div>
    </div>

  </div>
  <!-- /.container-fluid -->
@endsection