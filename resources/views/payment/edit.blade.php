@extends('layouts.app')
@section('title','Ndrysho Pagesën')
@section('payment','active')
@section('scripts')
function deleteCart(id) 
  {
   
    $.ajax({
      type:'POST',
      url:'/deleteCart',
      data:{"id":id},
      success:function(data)
      {
        $("#payment-table").load( "/payment/create #payment-table");
      }
    });
  }
  
  function addToCart(id, name,price) 
  {
    var  discount= $('#discount-'+id).val();
    var tooth = $('#tooth-'+id).val();
    var quantity = $('#quantity-'+id).val();
    $.ajax({
      type:'POST',
      url:'/addCart',
      data:{
        "id":id,
        "name": name,
        "price": price,
        "discount": discount,
        "quantity": quantity,
        "tooth": tooth
      },
      success:function(data)
      {
        $("#payment-table").load( "/payment/create #payment-table");
      }
    });
  } 
@endsection
@section('content')
<div class="card o-hidden border-0 shadow-lg my-5">
  <div class="card-body p-0">
    <div class="row">

      <div class="col-lg-12">
        <div class="p-5">
          <div class="text-center">
            <h1 class="h4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-900 @endif mb-4">Ndrysho Pagesën!</h1>
          </div>
          <form method="POST" action="{{ route('payment.update',$payment->id) }}">
            {{ method_field('PUT') }}
            {{ csrf_field() }}
          <div class="form-group ">
            <label class="text-xs" for="pacient">Pacienti</label>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <button class="btn btn-outline-primary" type="button" id="create-termin-button" data-toggle="modal" data-target="#pacientModal"><i class="fa fa-plus"></i> </button>
                </div>
                <input readonly value="{{App\Pacient::getPacient($payment->pacient_id)}}" placeholder="Pacienti" class="form-control form-control-user @error('pacient-id') is-invalid @enderror" id="pacient" name="pacient"   data-toggle="modal" data-target="#pacientModal" />
                <input  hidden id="pacient-id" value="{{$payment->pacient_id}}"  name="pacient-id"/>
            <div class="input-group-append">
                <button type="button"  class="btn btn-outline-danger" onclick="document.getElementById('pacient').value=''; document.getElementById('pacient-id').value='';" >
                  <i class="fa fa-trash"></i>
                </button>
              </div>
        </div>
            <div class="modal fade" id="pacientModal" tabindex="-1"  role="dialog" aria-labelledby="pacientModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="pacientModalLabel">Zgjedh Pacientin</h5>
                    </div>
                    <div class="modal-body mx-2">
                      <table class="table table-bordered table-hover"  width="100%" cellspacing="0" id="searchPacient">
                        <thead class="bg-dark text-light">
                          <tr>
                            <th scope="col">Emri</th>
                            <th scope="col">Mbiemri</th>
                            <th scope="col">Nr Personal</th>
                            <th scope="col">Shto</th>
                          </tr>
                        </thead>
                        <tbody>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
                    </div>
                  </div>
                </div>
              </div>
          @if ($errors->has('pacient-id'))
                            <span class="help-block">
                                <strong class="text-danger"><small>{{ $errors->first('pacient-id') }}</small> </strong>
                            </span>
                        @endif
        </div>
          <div class="table-responsive">
            <table class="table" id="payment-table">
              <thead>
                <tr>
                  <th scope="col" class="border-0 bg-light">
                    <div class="p-2 px-3 text-uppercase">Produkti</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Dhëmbi</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Sasia</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Zbritja</div>
                  </th>
                 
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Qmimi</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Totali</div>
                  </th>
                  <th scope="col" class="border-0 bg-light">
                    <div class="py-2 text-uppercase">Largo</div>
                  </th>
                </tr>
              </thead>
              <tbody> 
                @foreach($items as $cart)
                <tr>
                  <th scope="row" class="border-0">
                    <form id="my_form" method="POST" action="updateCart">
                    <div class="p-2">
                      <div class="ml-3 d-inline-block align-middle">
                        <h5 class="mb-0"> {{$cart->name}}</h5>
                      </div>
                    </div>
                  </th>
                  <td class="border-0 align-middle"><strong>{{$cart->attributes->tooth}}</strong></td>
                  <td class="border-0 align-middle"><strong>{{$cart->quantity}}</strong></td>
                  <td class="border-0 align-middle"><strong>{{$cart->attributes->discount}} %</strong></td>
                  <td class="border-0 align-middle"><strong>{{$cart->price}} €</strong></td>
                  <td class="border-0 align-middle"><strong>{{($cart->price * $cart->quantity) - ((($cart->price * $cart->quantity) / 100 )* $cart->attributes->discount)}} €</strong></td>
                  <td class="border-0 align-middle">
  
                    <button type="button" onclick="deleteCart({{$cart->id}})" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              
                @endforeach
                <tr>
                  <td>  <button class="btn btn-outline-primary btn-circle " type="button"  data-toggle="modal" data-target="#serviceModalPayment"><i class="fa fa-plus"></i> </button></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td class="border-0 align-middle" >TOTALI</td>
                  <td class="border-0 align-middle "><strong>{{Cart::getTotal()}} €</strong></td>
                  <td><button type="submit" class="btn btn-success btn-circle " type="button"  ><i class="fa fa-print"></i> </button></form></td>
                </tr>
              </tbody>
            </table>
           
            <tbody>
              
            </tbody>
          </table>
        </div>
        <div class="modal fade " id="serviceModalPayment" tabindex="-1" role="dialog" aria-labelledby="serviceModalLabel" aria-hidden="true">
          <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="serviceModalLabel">Zgjedh Shërbimin</h5>
              </div>
              <div class="modal-body">
                <table class="table table-bordered table-hover" id="searchServicePayment"  width="100%" cellspacing="0" >
                  <thead class="bg-dark text-light">
                    <tr>
                      <th scope="col">Shërbimi</th>
                      <th scope="col">Qmimi</th>
                      <th scope="col">Zbritja</th>
                      <th scope="col">Sasia</th>
                      <th scope="col">Dhëmbi</th>
                      <th scope="col">Shto</th>
                    </tr>
                  </thead>
                  <tbody >
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Mbylle</button>
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