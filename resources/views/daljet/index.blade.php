@extends('layouts.app')
@section('title','Daljet')
@section('daljet','active')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

    <!-- Page Heading -->
    <div class="row">
      <div class="col-sm-6">
        <h1 class="h3 mb-4 text-gray-800">Daljet</h1>
      </div>
      <div class="col-sm-6 ">
          <a href="/daljet/create" class="btn btn-circle btn-success float-right"><i class="fa fa-plus"></i></a>
        </div>
    </div>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lista e daljeve</h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="DaljetdataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>Subjekti</th>
                <th>Nr.Faturës</th>
                <th>Afati</th>
                <th>Vlera</th>
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
@endsection