<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacient;
use DB;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $pacients = Pacient::where('first_name','LIKE','%'.$request->search."%")
        ->orWhere('last_name','LIKE','%'.$request->search."%")
        ->orWhere('personal_number','LIKE','%'.$request->search."%")
        ->orWhere('city','LIKE','%'.$request->search."%")
        ->orWhere('residence','LIKE','%'.$request->search."%")
        ->orWhere('address','LIKE','%'.$request->search."%")
        ->orWhere('fathers_name','LIKE','%'.$request->search."%")
        ->orWhere('phone','LIKE','%'.$request->search."%")
        ->orWhere('email','LIKE','%'.$request->search."%")
        ->paginate(30);	
        return view('search')->with('pacients',$pacients)->with('keyword',$request->search);
    }


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

    public function searchVisit(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $visits=DB::table('visits')
            ->join('users', 'users.id', '=', 'visits.user_id')
            ->join('pacients', 'pacients.id', '=', 'visits.pacient_id')
            ->select('visits.*', 'users.name', 'pacients.first_name', 'pacients.last_name', 'pacients.personal_number')
            ->where('pacients.first_name','LIKE','%'.$request->search."%")
            ->orWhere('pacients.last_name','LIKE','%'.$request->search."%")
            ->orWhere('visits.date_of_visit','LIKE','%'.$request->search."%")
            ->limit(25)
            ->get();
            if($visits)
            {
                foreach ($visits as $key => $visit) 
                {
                    $output.="<tr>".
                    "<td>".$visit->first_name."</td>".
                    "<td>".$visit->last_name."</td>".
                    "<td>".$visit->date_of_visit."</td>".
                    "<td>".$visit->time_of_visit."</td>".
                    "<td><a class=\"btn btn-circle btn-secondary btn-sm\"   data-dismiss=\"modal\" onclick=\"document.getElementById('visit').value = '".$visit->first_name.' '.$visit->last_name.' ('.$visit->date_of_visit.' | '.$visit->time_of_visit.') '. "';
                        document.getElementById('visit-id').value = '".$visit->id."';\" ><i class=\"fa text-light fa-arrow-right\"></i></a>
                        </td>".
                    "</tr>";
                }   
                return Response($output);
            }
        }
    }

    public function searchService(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $services=DB::table('services')
            ->where('name','LIKE','%'.$request->search."%")
            ->limit(25)
            ->get();
            if($services)
            {
                foreach ($services as $key => $service) 
                {
                    $output.="<tr>".
                    "<td>".$service->name."</td>".
                    "<td>".$service->price."</td>".
                    "<td>".$service->discount."</td>".
                    "<td><a class=\"btn btn-circle btn-secondary btn-sm\"   data-dismiss=\"modal\" onclick=\"
                        var sel = document.getElementById('services');    
                        var opt = document.createElement('option');
                        var inp = document.getElementById('service-list');
                        opt.appendChild( document.createTextNode('".$service->name."') );
                        opt.value = '".$service->id."';
                        sel.appendChild(opt); 
                        inp.value += '".$service->id."' +   ',';
                        \" ><i class=\"fa text-light fa-arrow-right\"></i></a>
                        </td>".
                    "</tr>";
                }   
                return Response($output);
            }
        }
    }

    public function searchTreatment(Request $request)
    {
        if($request->ajax())
        {
            $output="";
            $treatments=DB::table('treatments')
            ->join('pacients', 'pacients.id', '=', 'treatments.pacient_id')
            ->select('treatments.*','pacients.first_name', 'pacients.last_name')
            ->where('pacients.first_name','LIKE','%'.$request->search."%")
            ->orWhere('pacients.last_name','LIKE','%'.$request->search."%")
            ->orWhere('treatments.starting_date','LIKE','%'.$request->search."%")
            ->orWhere('treatments.duration','LIKE','%'.$request->search."%")
            ->limit(25)
            ->get();
            if($treatments)
            {
                foreach ($treatments as $key => $treatment) 
                {
                    $output.="<tr>".
                    "<td>".$treatment->first_name." ".$treatment->last_name."</td>".
                    "<td>".$treatment->starting_date."</td>".
                    "<td>".$treatment->duration."</td>".
                    "<td><a class=\"btn btn-circle btn-secondary btn-sm\"   data-dismiss=\"modal\" onclick=\"document.getElementById('treatment').value = '".$treatment->first_name.' '.$treatment->last_name.' ('.$treatment->starting_date.' | '.$treatment->duration.') '. "';
                        document.getElementById('treatment-id').value = '".$treatment->id."';
                        document.getElementById('pacient-id').value = '".$treatment->pacient_id."';\" ><i class=\"fa text-light fa-arrow-right\"></i></a>
                        </td>".
                    "</tr>";
                }   
                return Response($output);
            }
        }
    }


    
}
