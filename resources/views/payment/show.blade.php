@extends('layouts.app')
@section('title','Shiko Pagese')
@section('payment','active')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-sm-6">
            <h1 class="h3 mb-4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-800 @endif">Fatura</h1>
          </div>
          <div class="col-sm-6 d-flex justify-content-end ">
                <a class="btn mr-1 btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                <a href="/payment/{{$payment->id}}/edit"  class="btn mr-1  btn-circle btn-primary"><i class="fa fa-pen"></i></a>
                <button class="btn btn-circle mr-1  btn-danger" data-toggle="modal" data-target="#fshijModal{{$payment->id}}"><i class="fa fa-trash"></i></button>
                <div class="modal fade" id="fshijModal{{$payment->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$payment->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fshijModalLabel{{$payment->id}}">Fshij Raportin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                A jeni i sigurtë që doni të vazhdoni?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                <form class="d-inline" method="POST" action="{{ route('payment.destroy',$payment->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div> 
                <form method="GET" action="{{ url('fatura') }}" class="d-inline form-inline">
                <input id="id" hidden name="id" value="{{$payment->id}}"/>
              <button type="submit" class="btn btn-circle btn-success "><i class="fa fa-print"></i></button>
              </form>
            </div>
        </div>
        
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4 p-5">
            <table cellspacing="0" border="0">
                <colgroup width="55"></colgroup>
                <colgroup width="669"></colgroup>
                <colgroup width="373"></colgroup>
                <colgroup width="349"></colgroup>
                <tr>
                    <td height="39" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" size=4> Ordinanca  stomatologjike</font></td>
                    <td align="left" valign=bottom><b><font face="Times New Roman" size=6><br></font></b></td>
                    <td align="left" valign=bottom><font face="Times New Roman" size=5><br></font></td>
                </tr>
                <tr>
                    <td height="39" align="left" valign=bottom><b><font face="Times New Roman" size=6><br></font></b></td>
                    <td align="left" valign=bottom><b><font face="Times New Roman" size=6>  &quot; M E T R O P O L I S &quot;</font></b></td>
                    <td align="left" valign=bottom><font face="Arial"><br></font></td>
                    <td align="left" valign=bottom><font face="Arial"><br></font></td>
                </tr>
                <tr>
                    <td height="26" align="left" valign=bottom><font face="Arial"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman" size=4><br></font></td>
                    <td align="left" valign=bottom><font face="Arial"><br></font></td>
                    <td align="left" valign=bottom><font face="Arial"><br></font></td>
                </tr>
                <tr>
                    <td height="26" align="left" valign=bottom><font face="Times New Roman" size=4><br></font></td>
                    <td align="left" valign=bottom><font face="Arial" size=4    >Prizren, Sh.i Lidhjes,8</font></td>
                    <td colspan=2 align="center" valign=bottom><b><font face="Times New Roman" size=4>Shfrytëzuesi i shërbimeve</font></b></td>
                    </tr>
                <tr>
                    <td height="26" align="left" valign=bottom><font face="Times New Roman" size=4><br></font></td>
                    <td align="left" valign=bottom><font face="Arial" size=4>Nr. regj: 810982464</font></td>
                    <td colspan=2 rowspan=2 align="center" valign=bottom><font face="Times New Roman"><u>{{$pacient->first_name}} {{$pacient->fathers_name}} {{$pacient->last_name}}</ul></font></td>
                    </tr>
                <tr>	
                    <td height="18" align="left" valign=bottom><font face="Arial"><br></font></td>
                    <td align="left" valign=bottom><font face="Arial"><br></font></td>
                    </tr>
                <tr>
                    <td height="26" align="left" valign=bottom><font face="Arial"><br></font></td>
                <td align="left" valign=bottom><font face="Times New Roman" size=4>Fatura nr. <u>{{$payment->id}}</ul></font></td>
                    <td colspan=2 align="center" valign=bottom><font face="Times New Roman"><u>{{$pacient->personal_number}} {{$pacient->residence}} {{$pacient->city}}</ul></font></td>
                    </tr>
                <tr>
                    <td height="18" align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                </tr>
                <tr>
                    <td height="26" align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=4>Përshkrimi i punës së kryer</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=4>Dhëmb</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=4>Çmimi</font></td>
                </tr>
                @foreach($payment->services as $service)
                <tr>
                    <td height="26" align="left" valign=bottom><font face="Times New Roman" size=4><br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;vertical-align: middle;" align="left"  > <font face="Times New Roman" size=4><br>{{$service->name}}</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;vertical-align: middle;" align="center" ><font face="Times New Roman" size=4><br>{{$service->pivot->tooth}}</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000;vertical-align: middle;" align="center" ><font face="Times New Roman" size=4><br>{{$service->price - ($service->price * ($service->pivot->discount /100))}} € x {{$service->pivot->quantity}}</font></td>
                </tr>
                @endforeach
                <tr>
                    <td style="border-right: 1px solid #000000" height="26" align="left" valign=bottom><font face="Times New Roman" size=4><br></font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center" valign=middle><font face="Times New Roman" size=4>V  L  E  R  A</font></td>
                    <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=middle><font face="Times New Roman" size=4><br></font></td>
                    <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" align="center" valign=middle><font face="Times New Roman" size=4><br>{{$payment->value}} €</font></td>
                </tr>  
                <tr>
                    <td height="18" align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                    <td align="left" valign=bottom><font color="#000000"><br></font></td>
                </tr>
            <tr>
                <td height="23" align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                <td align="left" valign=bottom><b><font face="Times New Roman" size=4>P r i z r e n</font></b></td>
                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                <td colspan=2 align="center" valign=bottom><b><font face="Times New Roman" size=4>Personi i përgjegjës</font></b></td>
            </tr>
            <tr>
                <td height="23" align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                <td align="left" valign=bottom><b><font face="Times New Roman" size=4><br></font></b></td>
                <td align="left" valign=bottom><b><font face="Times New Roman" size=4><br></font></b></td>
                <td align="left" valign=bottom><b><font face="Times New Roman" size=4><br></font></b></td>
            </tr>
            <tr>
                <td height="23" align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                <td align="left" valign=bottom><b><font face="Times New Roman" size=4>Ditë {{date('d/m/Y', strtotime($payment->created_at))}}</font></b></td>
                <td align="left" valign=bottom><font color="#000000"><br></font></td>
                <td colspan=2 align="center" valign=bottom><b><font face="Times New Roman" size=4>___________________</font></b></td>
            </tr>
            <tr>
                <td height="18" align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                <td align="left" valign=bottom><font color="#000000"><br></font></td>
            </tr>
            <tr>
                <td height="18" align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                <td align="left" valign=bottom><font face="Times New Roman"><br></font></td>
                <td align="left" valign=bottom><font color="#000000"><br></font></td>
            </tr>
             </table>
</div>
</div>
    @endsection