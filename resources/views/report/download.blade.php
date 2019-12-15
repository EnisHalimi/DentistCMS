<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title></title>
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Calibri"; font-size:x-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  } 
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  } 
		comment { display:none;  } 
        table {width:100%}
	</style>
	
</head>

<body>
<table cellspacing="0" border="0">
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
		<td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=4>Ditë {{date('d/m/Y', strtotime($report->created_at))}} g.</font></i></b></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=bottom><b><i><font face="Palatino Linotype" size=4>____________________</font></i></b></td>
	</tr>
</table>
</body>

</html>
