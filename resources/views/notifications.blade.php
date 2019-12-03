@extends('layouts.app')
@section('title','Njoftimet')
@section('dashboard','active')
@section('content')

 <!-- Begin Page Content -->
 <div class="container-fluid mt-4">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-sm-6">
            <h1 class="h3 mb-4 text-gray-800">Njoftimet</h1>
          </div>
        </div>
        
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e njoftimeve</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="NotificationsdataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Përshkrimi</th>
                    <th>Data</th>
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