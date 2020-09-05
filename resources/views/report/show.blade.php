@extends('layouts.app')
@section('title','Shiko Raport')
@section('report','active')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid mt-4">

        <!-- Page Heading -->
        <div class="row">
          <div class="col-sm-6">
            <h1 class="h3 mb-4 @if(App\User::getAppTheme() == true) text-gray-100 @else text-gray-800 @endif">Raporti</h1>
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
                <form method="GET" action="{{ url('raporti') }}" class="d-inline form-inline">
                <input id="id" hidden name="id" value="{{$report->id}}"/>
              <button type="submit" class="btn btn-circle btn-success "><i class="fa fa-print"></i></button>
              </form>
            </div>
        </div>
        
        
        <!-- DataTales Example -->
        <div class="card shadow mb-4 p-5">
            <table width="100%" cellpadding="4" cellspacing="0">
            
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm; text-align: center"><p lang="en" class="western" align="center" style="margin-top: 0.21cm; font-style: normal; page-break-inside: avoid; text-decoration: none; page-break-after: avoid">
                        <font color="#365f91"><font face="Cambria, serif"><font size="6" style="font-size: 28pt"><b><span style="text-decoration: none">METROPOLIS</span></b></font></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm; text-align: center"><p lang="en" class="western" align="center" style="margin-top: 0.21cm; font-style: normal; text-decoration: none">
                        <font color="#365f91"><font face="Cambria, serif"><font size="4" style="font-size: 14pt"><b><span style="text-decoration: none">Ordinanca
                        Stomatologjike</span></b></font></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm; text-align: center"><p lang="en" class="western" align="center" style="margin-top: 0.21cm; font-style: normal; text-decoration: none">
                        <font color="#365f91"><font face="Cambria, serif"><font size="4" style="font-size: 14pt"><b><span style="text-decoration: none">Prizren
                                                                                  </span></b></font></font></font>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="text-decoration: none">
                        <br/>
            
                        </p>
                    </td>
                </tr>
                <tr valign="top">
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="2" width="308" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="center" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>Ordinanca
                        Stomatologjike </b></span></font></font></span></font></font>
                        </p>
                    </td>
                    <td colspan="2" width="280" style="background: transparent" style="border: none; padding: 0cm; text-align: right"><p lang="en-US" class="western" align="center" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>Nr.fiskal:
                        600287496</b></span></font></font></span></font></font></p>
                    </td>
                </tr>
                <tr valign="top">
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="2" width="308" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="center" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>	</b></span></font></font><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>Metropolis
                            </b></span></font></font></span></font></font></p>
                    </td>
                    <td colspan="2" width="280" style="background: transparent" style="border: none; padding: 0cm; text-align: right"><p lang="en-US" class="western" align="center" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>Mob:
                         +3849727700</b></span></font></font></span></font></font></p>
                    </td>
                </tr>
                <tr valign="top">
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="2" width="308" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="center" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>Prizren
                        – Republika e Kosovës</b></span></font></font></span></font></font></p>
                    </td>
                    <td colspan="2" width="280" style="background: transparent" style="border: none; padding: 0cm; text-align: right"><p lang="en-US" class="western" align="center" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>E-mail:
                        </b></span></font></font><font color="#000080"><span lang="zxx"><u><a href="mailto:metropolis@gmail.com"><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>metropolis@gmail.com</b></span></font></font></a></u></span></font></span></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="text-decoration: none">
                        <br/>
            
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm; text-align: center"><p lang="en-US" class="western" align="center" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span lang="en"><b>RAPORT
                        STOMATOLOGJIK                 </b></span></font></font><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>
                                                                     </b></span></font></font></span></font></font>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="text-decoration: none">
                        <br/>
            
                        </p>
                    </td>
                </tr>
                <tr valign="top">
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td width="164" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span lang="en"><b>Pacienti:</b></span></font></font></p>
                    </td>
                    <td width="136" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 10pt"><span style="text-decoration: none">{{$pacient->first_name}} {{$pacient->fathers_name}} {{$pacient->last_name}} </span></font></font></p>
                    </td>
                    <td width="136" style="background: transparent" style="border: none; padding: 0cm; text-align: right"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span lang="en"><b>Nr personal:</b></span></font></font></p>
                    </td>
                    <td width="136" style="background: transparent" style="border: none; padding: 0cm; text-align: right"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 10pt"><span style="text-decoration: none">{{$pacient->personal_number}}  </span></font></font></p>
                    </td>
                </tr>
                <tr valign="top">
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td width="164" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="font-style: normal; text-decoration: none">
                        <font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span lang="en"><b>Data e lindjes:</b></span></font></font></p>
                    </td>
                    <td width="136" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 10pt"><span style="text-decoration: none">{{$pacient->date_of_birth}}</span></font></font></p>
                    </td>
                    <td width="136" style="background: transparent" style="border: none; padding: 0cm ; text-align: right"><p lang="en" class="western" align="left" style="font-style: normal; text-decoration: none">
                        <font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span lang="en"><b>Adresa:</b></span></font></font></p>
                    </td>
                    <td width="136" style="background: transparent" style="border: none; padding: 0cm; text-align: right"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 10pt"><span style="text-decoration: none">{{$pacient->address}}</span></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="text-decoration: none">
                        <br/>
            
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><span lang="en"><b>Ankesa
                        e pacientit</b></span></font><font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span lang="en"><b>:
                        </b></span></font></font></span></font></font>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span style="text-decoration: none">{{$report->complaint}}</span></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="text-decoration: none">
                        <br/>
            
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="font-style: normal; text-decoration: none">
                        <font face="Calibri, sans-serif"><font size="3" style="font-size: 12pt"><b><span style="text-decoration: none">Vlerësimi
                        i mjekut: </span></b></font></font>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none">{{$report->evaluation}}</span></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="text-decoration: none">
                        <br/>
            
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><span lang="en"><b>Diagnoza:
                        </b></span></font><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>
                        </b></span></font></font></span></font></font>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none">{{$report->diagnosis}}</span></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="text-decoration: none">
                        <br/>
            
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><span lang="en"><b>Trajtimi:
                        </b></span></font><font face="Calibri, sans-serif"><font size="2" style="font-size: 10pt"><span lang="en"><b>
                        </b></span></font></font></span></font></font>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left">
                        @foreach($treatments as $treatment)
                                @foreach($treatment->services as $service)
                                    <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none">{{$service->name}} me datë {{$treatment->starting_date}}</span></font></font></p>
                                    <br>
                                @endforeach
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="text-decoration: none">
                        <br/>
            
                        </p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><span lang="en"><b>Rekomandimi</b></span></font><font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span lang="en"><b>:</b></span></font></font></span></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none">{{$report->recommendation}}</span></font></font></p>
                    </td>
                </tr>
                <tr>
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td colspan="4" width="596" valign="top" style="background: transparent" style="border: none; padding: 0cm"><p lang="en" class="western" align="left" style="text-decoration: none">
                        <br/>
            
                        </p>
                    </td>
                </tr>
                <tr valign="top">
                    <td width="40" align="left" valign=bottom><font color="#000000"><br></font></td>
                    <td width="164" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span lang="en"><b>Data
                        e vizitës:</b></span></font></font></span></font></font></p>
                    </td>
                    <td width="136" style="background: transparent" style="border: none; padding: 0cm"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none">{{date('d/m/Y', strtotime($report->created_at))}}</span></font></font></p>
                    </td>
                    <td width="136" style="background: transparent" style="border: none; padding: 0cm; text-align: right"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none"><font face="Calibri, sans-serif"><font size="2" style="font-size: 11pt"><span lang="en"><b>Mjeku:</b></span></font></font></span></font></font></p>
                    </td>
                    <td width="136" style="background: transparent" style="border: none; padding: 0cm; text-align: right"><p lang="en-US" class="western" align="left" style="font-style: normal; font-weight: normal; text-decoration: none">
                        <font face="Liberation Serif, serif"><font size="3" style="font-size: 12pt"><span style="text-decoration: none">{{$user->name}} <br>_____________</span></font></font></p>
                    </td>
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