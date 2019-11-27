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
}
