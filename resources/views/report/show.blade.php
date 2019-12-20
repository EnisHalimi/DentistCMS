@extends('layouts.app')
@section('title','Shiko Raport')
@section('report','active')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-sm-6">
            <h1 class="h3 mb-4 text-gray-800">Fatura</h1>
          </div>
          <div class="col-sm-6 d-flex justify-content-end ">
                <a class="btn mr-1 btn-circle btn-secondary" href="{{ url()->previous() }}" ><i class="fa fa-chevron-left"></i></a>
                <a href="/report/{{$report->id}}/edit"  class="btn mr-1  btn-circle btn-primary"><i class="fa fa-pen"></i></a>
                <button class="btn btn-circle mr-1  btn-danger" data-toggle="modal" data-target="#fshijModal{{$report->id}}"><i class="fa fa-trash"></i></button>
                <div class="modal fade" id="fshijModal{{$report->id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$report->id}}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="fshijModalLabel{{$report->id}}">Fshij Raportin</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                A jeni i sigurtë që doni të vazhdoni?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                                <form class="d-inline" method="POST" action="{{ route('report.destroy',$report->id)}}" accept-charset="UTF-8">
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                                
                            </div>
                        </div>
                    </div>
                </div> 
                <form method="GET" action="{{ url('pdf') }}" class="d-inline form-inline">
                <input id="id" hidden name="id" value="{{$report->id}}"/>
              <button type="submit" class="btn btn-circle btn-success "><i class="fa fa-print"></i></button>
              </form>
            </div>
        </div>
        
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4 p-3">
                  <div class="table-responsive"><table cellspacing="0" border="0">
                    <colgroup width="55"></colgroup>
                    <colgroup width="669"></colgroup>
                    <colgroup width="373"></colgroup>
                    <colgroup width="349"></colgroup>
                    <tr>
                        <td height="39" align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype" size=4> Ordinanca  stomatologjike</font></i></td>
                        <td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=6><br></font></i></b></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype" size=5><br></font></i></td>
                    </tr>
                    <tr>
                        <td height="39" align="left" valign=bottom><b><i><font face="Palatino Linotype" size=6><br></font></i></b></td>
                        <td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=6>  &quot; M E T R O P O L I S &quot;</font></i></b></td>
                        <td align="left" valign=bottom><font face="Arial"><br></font></td>
                        <td align="left" valign=bottom><font face="Arial"><br></font></td>
                    </tr>
                    <tr>
                        <td height="26" align="left" valign=bottom><font face="Arial"><br></font></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype" size=4><br></font></i></td>
                        <td align="left" valign=bottom><font face="Arial"><br></font></td>
                        <td align="left" valign=bottom><font face="Arial"><br></font></td>
                    </tr>
                    <tr>
                        <td height="26" align="left" valign=bottom><i><font face="Palatino Linotype" size=4><br></font></i></td>
                        <td align="left" valign=bottom><font face="Arial" size=4 color="#222222">Prizren, Sh.i Lidhjes,8</font></td>
                        <td colspan=2 align="center" valign=bottom><b><i><font face="Palatino Linotype" size=4>Shfrytëzuesi i shërbimeve</font></i></b></td>
                        </tr>
                    <tr>
                        <td height="26" align="left" valign=bottom><i><font face="Palatino Linotype" size=4><br></font></i></td>
                        <td align="left" valign=bottom><font face="Arial" size=4>Nr. regj: 810982464</font></td>
                        <td colspan=2 rowspan=2 align="center" valign=bottom><i><font face="Palatino Linotype"><u>{{$pacient->first_name}} {{$pacient->fathers_name}} {{$pacient->last_name}}</ul></font></i></td>
                        </tr>
                    <tr>
                        <td height="18" align="left" valign=bottom><font face="Arial"><br></font></td>
                        <td align="left" valign=bottom><font face="Arial"><br></font></td>
                        </tr>
                    <tr>
                        <td height="26" align="left" valign=bottom><font face="Arial"><br></font></td>
                    <td align="left" valign=bottom><i><font face="Palatino Linotype" size=4>Fatura nr. <u>{{$report->id}}</ul></font></i></td>
                        <td colspan=2 align="center" valign=bottom><i><font face="Palatino Linotype"><u>{{$pacient->personal_number}} {{$pacient->residence}} {{$pacient->city}}</ul></font></i></td>
                        </tr>
                    <tr>
                        <td height="18" align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                    </tr>
                    <tr>
                        <td height="26" align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><i><font face="Palatino Linotype" size=4>Përshkrimi i punës së kryer</font></i></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><i><font face="Palatino Linotype" size=4>Dhëmb</font></i></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom><i><font face="Palatino Linotype" size=4>Çmimi</font></i></td>
                    </tr>
                    @foreach($services as $service)
                    <tr>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="26" align="left" valign=bottom><i><font face="Palatino Linotype" size=4><br></font></i></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom> <i><font face="Palatino Linotype" size=4><br>{{$service->name}}</font></i></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom><i><font face="Palatino Linotype" size=4><br></font></i></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="left" valign=bottom><i><font face="Palatino Linotype" size=4><br>{{$service->price - ($service->price * ($service->discount /100))}} €</font></i></td>
                    </tr>
                    @endforeach
                    <tr>
                        <td style="border-top: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" height="26" align="left" valign=bottom><i><font face="Palatino Linotype" size=4><br></font></i></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="center" valign=bottom><i><font face="Palatino Linotype" size=4>V  L  E  R  A</font></i></td>
                        <td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000" align="left" valign=bottom><i><font face="Palatino Linotype" size=4><br></font></i></td>
                        <td style="border-top: 2px solid #000000; border-bottom: 2px solid #000000; border-left: 2px solid #000000; border-right: 2px solid #000000" align="left" valign=bottom><i><font face="Palatino Linotype" size=4><br>{{App\Report::getTotal($report->id)}} €</font></i></td>
                    </tr>
                    <tr>
                        <td height="18" align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                    </tr>
                    <tr>
                        <td height="18" align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                    </tr>
                    <tr>
                        <td height="18" align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                    </tr>
                    <tr>
                        <td height="18" align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                    </tr>
                    <tr>
                        <td height="23" align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=4>P r i z r e n</font></i></b></td>
                        <td colspan=2 align="center" valign=bottom><b><i><font face="Palatino Linotype" size=4>Personi i përgjegjës</font></i></b></td>
                        </tr>
                    <tr>
                        <td height="23" align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=4><br></font></i></b></td>
                        <td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=4><br></font></i></b></td>
                        <td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=4><br></font></i></b></td>
                    </tr>
                    <tr>
                        <td height="23" align="left" valign=bottom><i><font face="Palatino Linotype"><br></font></i></td>
                        <td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=4>Ditë {{$report->created_at}} g.</font></i></b></td>
                        <td align="left" valign=bottom><font color="#000000"><br></font></td>
                        <td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=4>____________________</font></i></b></td>
                    </tr>
                </table>
   
        </div>
</div>
</div>
    @endsection