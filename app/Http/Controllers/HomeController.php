<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use App\Treatment;
use App\Pacient;
use App\Report;
use App\Services;
use App\Visit;
use App\Contact;
use App\Notifications;
use DataTables;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public static function numers()
    {
        return 0;
    }
    public function index()
    {
        $pacients = Pacient::orderBy('id', 'DESC');
        $appointements = Appointment::where('date_of_appointment','=',date("Y-m-d"))->orderBy('id', 'DESC')->paginate(15);
        $treatment = Treatment::where('created_at','=',date("Y-m-d"))->orderBy('id', 'DESC')->paginate(15);
        $visit = Visit::where('date_of_visit','=',date("Y-m-d"))->orderBy('id', 'DESC')->paginate(15);
        return view('index')->with('pacients', $pacients)
                            ->with('appointements', $appointements)
                            ->with('treatments', $treatment)
                            ->with('visits', $visit);
    }
    public function autocomplete()
    {
        $pacients = Pacient::orderBy('id', 'ASC')->get();
        foreach($pacients as $pacient)
        {
            $list[]= "$pacient->first_name $pacient->last_name $pacient->personal_number,$pacient->id";
        }
        return response()->json($list);
    }

    public function notifications()
    {
        $notifications = Notifications::orderBy('created_at', 'DESC');
        return view('notifications')->with('notifications', $notifications);
                            
    }

    public function settings()
    {
        $settings = DB::table('settings')->first();
        return view('settings')->with('settings', $settings);
                            
    }

    public function getNotificationsDataTable()
    {
        $notifications = Notifications::get();
        $table = DataTables::of($notifications)
        ->editColumn ('description','@if($opened) {{$description}} @else <p style="color:black"><b>{{$description}}</b></p> @endif')
        ->editColumn ('created_at','@if($opened) {{$created_at}} @else  <p style="color:black"><b>{{$created_at}}</b></p> @endif')
        ->rawColumns(['description','created_at'])
        ->make(true);
        return $table;
                            
    }
    
}
