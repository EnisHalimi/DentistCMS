<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacient;
use App\User;
use App\Treatment;
use App\Services;
use DB;
use DataTables;



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
        $pacients = Pacient::all();
        $table = DataTables::of($pacients)
        ->addColumn('Shto' ,'<a class="btn btn-circle btn-secondary btn-sm"    data-dismiss="modal" onclick="document.getElementById(\'pacient\').value = \'{{$first_name}} {{$last_name}} {{$personal_number}}\';
        document.getElementById(\'pacient-id\').value = \'{{$id}}\';" ><i class="fa text-light fa-arrow-right"></i></a>')
        ->rawColumns(['Shto'])
        ->make(true);
        return $table;
    }

    public function searchUser(Request $request)
    {
        $users = User::all();
        $table = DataTables::of($users)
        ->addColumn('Shto' ,'<a class="btn btn-circle btn-secondary btn-sm"    data-dismiss="modal" onclick="document.getElementById(\'user\').value = \'{{$name}}\';
        document.getElementById(\'user-id\').value = \'{{$id}}\';" ><i class="fa text-light fa-arrow-right"></i></a>')
        ->rawColumns(['Shto'])
        ->make(true);
        return $table;
       
    }


    public function searchService(Request $request)
    {
        $services = Services::all();
        $table = DataTables::of($services)
        ->addColumn('Shto' ,'<a class="btn btn-circle btn-secondary btn-sm"   data-dismiss="modal" onclick="
        var sel = document.getElementById(\'services\');    
        var opt = document.createElement(\'option\');
        var inp = document.getElementById(\'service-list\');
        opt.appendChild( document.createTextNode(\'{{$name}}\') );
        opt.value = \'{{$id}}\';
        sel.appendChild(opt); 
        inp.value += \'{{$id}}\' +\',\';
        " ><i class="fa text-light fa-arrow-right"></i></a>')
        ->rawColumns(['Shto'])
        ->make(true);
        return $table;
    }

    public function searchServicePayment(Request $request)
    {
        $services = Services::all();
        $table = DataTables::of($services)
        ->addColumn('Shto' ,'
        <a class="btn btn-circle btn-secondary btn-sm"  onclick="
        addToCart({{$id}},\'{{$name}}\',{{$price}});
        " ><i class="fa text-light fa-arrow-right"></i></a>
        ')
        ->addColumn('quantity' ,'
        <input class="w-50" type="text" id="quantity-{{$id}}" name="quantity" value="1">    
        ')
        ->addColumn('tooth' ,'
            <input class="w-50" type="text" id="tooth-{{$id}}" name="tooth" value="0">    
        ')
        ->editColumn('discount',' <input class="w-50" type="text" id="discount-{{$id}}" name="discount" value="{{$discount}}"> %')
        ->rawColumns(['Shto','quantity','tooth','discount'])
        ->make(true);
        return $table;
    }


    public function searchTreatment(Request $request)
    {
        $treatments = Treatment::all();
        $table = DataTables::of($treatments)
        ->editColumn('pacient_id','{{App\Pacient::getPacientName($pacient_id)}}')
        ->addColumn('Shto' ,'<a class="btn btn-circle btn-secondary btn-sm"   data-dismiss="modal" onclick="document.getElementById(\'treatment\').value = \'{{App\Pacient::getPacientName($pacient_id)}} ( {{$starting_date}} | {{$duration}})\';
        document.getElementById(\'treatment-id\').value = \'{{$id}}\';
        document.getElementById(\'pacient-id\').value = \'{{$pacient_id}}\';"><i class="fa text-light fa-arrow-right"></i></a>')
        ->rawColumns(['Shto'])
        ->make(true);
        return $table;
    }


    
}
