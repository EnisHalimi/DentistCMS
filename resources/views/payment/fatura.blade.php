<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title>Printimi i Fatures</title>
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Times New Roman"; font-size:1rem }
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
		<td align="left" valign=bottom><font face="Arial" size=4 >Prizren, Sh.i Lidhjes,8</font></td>
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
</table>
<div style=" position: absolute;
bottom: 0">
 <table>
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
	<td align="left" valign=bottom><b><font face="Times New Roman" size=4>Ditë {{$payment->created}} g.</font></b></td>
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
</body>

</html>
