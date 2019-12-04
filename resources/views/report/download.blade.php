<table style="color: black" cellspacing="0" border="0">
        <colgroup width="15"></colgroup>
        <colgroup width="125"></colgroup>
        <colgroup width="144"></colgroup>
        <colgroup width="189"></colgroup>
        <colgroup width="114"></colgroup>
        <colgroup width="111"></colgroup>
        <tr>
            <td height="127" align="left" valign=bottom><font face="Garamond"><br></font></td>
            <td colspan=2 align="left" valign=bottom><font color="#7F7F7F"><img src="https://financialtribune.com/sites/default/files/field/image/08_implant.png" width=200 height=200 hspace=57 vspace=31>
            </font></td>
            <td colspan=3 align="right" valign=middle><b><font face="Calibri" size=7 color="#5590A8">FATURË</font></b></td>
            </tr>
        <tr>
            <td colspan=2 height="22" align="left" valign=bottom><b><font face="Garamond"><br></font></b></td>
            <td colspan=4 align="left" valign=bottom><font face="Garamond"><br></font></td>
            </tr>
        <tr>
            <td height="22" align="left" valign=bottom><font face="Garamond"><br></font></td>
            <td align="left" valign=bottom><b><font face="Calibri" color="#231F20">Metropolis</font></b></td>
            <td align="left" valign=bottom><b><font face="Calibri" color="#231F20"><br></font></b></td>
            <td align="left" valign=bottom><font size=3 color="#00AEDB"><br></font></td>
            <td align="left" valign=bottom><font size=3 color="#00AEDB"><br></font></td>
            <td align="left" valign=bottom><font size=3 color="#00AEDB"><br></font></td>
        </tr>
        <tr>
            <td height="22" align="left" valign=bottom><font face="Garamond" size=1 color="#4A4B4B"><br></font></td>
            <td colspan=2 align="left" valign=bottom><font face="Calibri">Rruga Besim Shala Nr.1</font></td>
            <td align="right" valign=bottom><b><font face="Calibri" color="#231F20">Fatura Nr :</font></b></td>
            <td colspan=3 align="left" valign=bottom><font face="Calibri">{{$report->id}}</font></td>
            </tr>
        <tr>
            <td height="22" align="left" valign=bottom><font face="Garamond" size=1 color="#4A4B4B"><br></font></td>
            <td colspan=2 align="left" valign=bottom><font face="Calibri">20000, Prizren, Kosovë</font></td>
            <td align="right" valign=bottom><b><font face="Calibri" color="#231F20">Date :</font></b></td>
        <td align="left" valign=bottom sdval="43803" sdnum="2057;2057;DD/MM/YYYY"><font face="Calibri">{{date('d/m/Y', strtotime($report->created_at))}}</font></td>
            <td align="left" valign=bottom sdnum="2057;1033;MMMM D\, YYYY;@"><font color="#4A4B4B"><br></font></td>
        </tr>
        <tr>
            <td height="22" align="left" valign=bottom><font face="Garamond" size=1 color="#4A4B4B"><br></font></td>
            <td colspan=2 align="left" valign=bottom><font face="Calibri">+383 49 727 700</font></td>
            <td align="right" valign=bottom><b><font face="Calibri" color="#231F20">Customer ID :</font></b></td>
            <td align="left" valign=bottom><font face="Calibri">{{$pacient->personal_number}}</font></td>
            <td align="left" valign=bottom><font color="#4A4B4B"><br></font></td>
        </tr>
        <tr>
            <td height="22" align="left" valign=bottom><font face="Garamond" size=1 color="#4A4B4B"><br></font></td>
            <td colspan=2 align="left" valign=bottom><font face="Calibri">metropolis@gmail.com</font></td>
            <td align="left" valign=bottom><font color="#4A4B4B"><br></font></td>
            <td align="left" valign=bottom><font color="#4A4B4B"><br></font></td>
            <td align="right" valign=bottom><font color="#4A4B4B"><br></font></td>
        </tr>
        <tr>
            <td height="22" align="left" valign=bottom><font size=1 color="#4A4B4B"><br></font></td>
            <td align="left" valign=bottom><font face="Calibri"><br></font></td>
            <td align="left" valign=bottom><font face="Calibri"><br></font></td>
            <td align="left" valign=bottom><font color="#4A4B4B"><br></font></td>
            <td align="left" valign=bottom><font color="#4A4B4B"><br></font></td>
            <td align="left" valign=bottom><font color="#4A4B4B"><br></font></td>
        </tr>
        <tr>
            <td height="22" align="center" valign=middle><font face="Calibri"><br></font></td>
        <td colspan=2 align="left" valign=bottom><font face="Calibri">{{$pacient->first_name}} {{$pacient->fathers_name}} {{$pacient->last_name}}</font></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
        </tr>
        <tr>
            <td height="22" align="left" valign=bottom><b><font size=1 color="#4A4B4B"><br></font></b></td>
        <td colspan=2 align="left" valign=bottom><font face="Calibri">{{date('d/m/Y',strtotime($pacient->date_of_birth))}}</font></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
        </tr>
        <tr>
            <td height="22" align="left" valign=bottom><font size=1 color="#4A4B4B"><br></font></td>
            <td colspan=2 align="left" valign=bottom><font face="Calibri">{{$pacient->address}}</font></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
        </tr>
        <tr>
            <td height="22" align="left" valign=bottom><font size=1 color="#4A4B4B"><br></font></td>
            <td colspan=2 align="left" valign=bottom><font face="Calibri">{{$pacient->residence}} {{$pacient->city}}</font></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
        </tr>
        <tr>
            <td height="22" align="left" valign=bottom><font size=1 color="#4A4B4B"><br></font></td>
            <td colspan=2 align="left" valign=bottom><font face="Calibri">{{$pacient->phone}} {{$pacient->email}}</font></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
            <td align="left" valign=bottom><b><font color="#4A4B4B"><br></font></b></td>
        </tr>
        <tr>
            <td colspan=6 height="22" align="left" valign=bottom><font size=1 color="#4A4B4B"><br></font></td>
            </tr>
        
        <tr>
            <td height="22" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="2057;0;0.00"><font size=1 color="#4A4B4B"><br></font></td>
            <td align="center" valign=bottom bgcolor="#FFFFFF" sdnum="2057;0;0.00"><font size=1 color="#4A4B4B"><br></font></td>
            <td align="left" valign=bottom bgcolor="#FFFFFF"><font size=1 color="#4A4B4B"><br></font></td>
            <td align="left" valign=bottom bgcolor="#FFFFFF"><font size=1 color="#4A4B4B"><br></font></td>
            <td style="border-right: 2px solid #ffffff" align="left" valign=bottom bgcolor="#FFFFFF"><font size=1 color="#4A4B4B"><br></font></td>
            <td align="right" valign=bottom bgcolor="#FFFFFF" sdnum="2057;0;_(&quot;$&quot;* #,##0.00_);_(&quot;$&quot;* \(#,##0.00\);_(&quot;$&quot;* &quot;-&quot;??_);_(@_)"><font size=1 color="#4A4B4B"><br></font></td>
        </tr>
        <tr>
            <td height="36" align="left" valign=bottom><font face="Calibri" color="#FFFFFF">QUANTITY</font></td>
            <td style="border-right: 2px solid #ffffff" colspan=2 align="left" valign=middle bgcolor="#5590A8"><b><font face="Calibri" size=3 color="#231F20">Shërbimi</font></b></td>
            <td style="border-right: 2px solid #ffffff" align="left" valign=middle bgcolor="#5590A8"><b><font face="Calibri" size=3 color="#231F20">Qmimi</font></b></td>
            <td style="border-right: 2px solid #ffffff" align="left" valign=middle bgcolor="#5590A8"><b><font face="Calibri" size=3 color="#231F20">Zbritja</font></b></td>
            <td align="left" valign=middle bgcolor="#5590A8"><b><font face="Calibri" size=3 color="#231F20">Qmimi Total</font></b></td>
        </tr>
        @foreach($services as $service)
        <tr>
            <td height="22" align="left" valign=middle sdnum="2057;0;0.00"><font size=1 color="#4A4B4B"><br></font></td>
            <td style="border-right: 2px solid #ffffff" colspan=2 align="left" valign=middle bgcolor="#E6E6E6">{{$service->name}}</td>
            <td style="border-right: 2px solid #ffffff" align="left" valign=middle bgcolor="#E6E6E6">{{$service->price}} €</td>
            <td style="border-right: 2px solid #ffffff" align="left" valign=middle bgcolor="#E6E6E6" sdnum="2057;0;&quot;$&quot;#,##0.00">{{$service->discount}} %</td>
        <td align="left" valign=middle bgcolor="#CFCFCF" sdnum="2057;0;&quot;$&quot;#,##0.00">{{$service->price - ($service->price * ($service->discount / 100))}} € </td>
        </tr>
        @endforeach
        <tr>
            <td height="27" align="left" valign=middle><font size=1 color="#4A4B4B"><br></font></td>
            <td align="left" valign=middle><font size=1 color="#4A4B4B"><br></font></td>
            <td align="left" valign=middle><font size=1 color="#4A4B4B"><br></font></td>
            <td align="left" valign=middle><font size=1 color="#4A4B4B"><br></font></td>
            <td style="border-right: 2px solid #ffffff" align="left" valign=middle><b><font size=3 color="#5590A8">TOTALI</font></b></td>
        <td align="left" valign=middle bgcolor="#5590A8" sdnum="2057;0;_(&quot;$&quot;* #,##0.00_);_(&quot;$&quot;* \(#,##0.00\);_(&quot;$&quot;* &quot;-&quot;??_);_(@_)">{{App\Report::getTotal($report->id)}} €<font size=1 color="#FFFFFF">  </font></td>
        </tr>
        <tr>
            <td height="17" align="left" valign=bottom><font face="Garamond"><br></font></td>
            <td align="left" valign=bottom><font face="Garamond"><br></font></td>
            <td align="left" valign=bottom><font face="Garamond"><br></font></td>
            <td align="left" valign=bottom><font face="Garamond"><br></font></td>
            <td align="left" valign=bottom><font face="Garamond"><br></font></td>
            <td align="left" valign=bottom><font face="Garamond"><br></font></td>
        </tr>
        <tr>
            <td height="25" align="left" valign=bottom><font face="Calibri" color="#FFFFFF"></font></td>
             <td align="left" colspan=3  valign=middle bgcolor="#5590A8"><b><font face="Calibri" size=3 color="#231F20">Përshkrimi i barnave</font></b></td>
        </tr>
        <tr>
            <td height="17" align="left" valign=bottom><font face="Garamond"><br></font></td>
            <td style="border-right: 2px solid #ffffff" colspan=3 align="left" valign=middle bgcolor="#E6E6E6">{{$report->description}}</td>
        </tr>
        <tr>
                <td height="17" align="left" valign=bottom><font face="Garamond"><br></font></td>
             
        </tr>
        <tr>
            <td height="28" align="left" valign=bottom><font face="Garamond"><br></font></td>
            <td colspan=5 align="center" valign=middle><font face="Calibri">Klinika Dentare Metropolis</font></td>
            </tr>
        <tr>
            <td height="36" align="center" valign=middle><b><font face="Calibri" size=3 color="#5590A8"><br></font></b></td>
            <td colspan=5 align="center" valign=middle><b><font face="Calibri" size=3 color="#5590A8">JU FALEMINDERIT QE NA ZGJODHET!</font></b></td>
            </tr>

            
    </table>
