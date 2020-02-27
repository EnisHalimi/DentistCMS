@extends('layouts.app')
@section('title','Kalendari')
@section('calendar','active')
@section('content')

 <!-- Begin Page Content -->
 <div class="container-fluid mt-4">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-sm-6">
            <h1 class="h3 mb-4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-800 @endif">Kalendari</h1>
          </div>
        </div>
        
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
          <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Lista e termineve</h6>
          </div>
          <div class="card-body">
            <div class="row">
                <div class="col-sm-2">
                <table class="border" >
                    <thead>
                        <th></th>
                        <th>Dentisti</th>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td><div class="p-2" style="background-color:{{$user->color}};"></div></td>
                            <td>{{$user->name}}</td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>

                </div>
                <div class="col-sm-10   ">
                    <div class="my-2" id='calendar'></div>
                </div>
            </div>
           
          </div>
        </div>
    
      </div>
      <!-- /.container-fluid -->
@endsection