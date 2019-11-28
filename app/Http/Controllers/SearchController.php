<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;


class SearchController extends Controller
{
    public function searchPacient(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $pacients=DB::table('pacients')
                        ->where('first_name','LIKE','%'.$request->search."%")
                        ->orWhere('last_name','LIKE','%'.$request->search."%")
                        ->orWhere('personal_number','LIKE','%'.$request->search."%")
                        ->limit(25)->get();
            if($pacients)
            {
                foreach ($pacients as $key => $pacient) 
                {
                    $data = $pacient->first_name." ".$pacient->last_name." ".$pacient->personal_number;
                    $output.="<tr>".
                    "<td>".$pacient->first_name."</td>".
                    "<td>".$pacient->last_name."</td>".
                    "<td>".$pacient->personal_number."</td>".
                    "<td><a class=\"btn btn-circle btn-secondary btn-sm\"    data-dismiss=\"modal\" onclick=\"document.getElementById('pacient').value = '".$data."';
                        document.getElementById('pacient-id').value = '".$pacient->id."';\" ><i class=\"fa text-light fa-arrow-right\"></i></a>
                        </td>".
                    "</tr>";
                }   
                return Response($output);
            }
        }
    }

    public function searchUser(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $users=DB::table('users')
                        ->where('name','LIKE','%'.$request->search."%")
                        ->limit(25)->get();
            if($users)
            {
                foreach ($users as $key => $user) 
                {
                    $output.="<tr>".
                    "<td>".$user->name."</td>".
                    "<td>".$user->email."</td>".
                    "<td><a class=\"btn btn-circle btn-secondary btn-sm\"   data-dismiss=\"modal\" onclick=\"document.getElementById('user').value = '".$user->name."';
                        document.getElementById('user-id').value = '".$user->id."';\" ><i class=\"fa text-light fa-arrow-right\"></i></a>
                        </td>".
                    "</tr>";
                }   
                return Response($output);
            }
        }
    }
}
