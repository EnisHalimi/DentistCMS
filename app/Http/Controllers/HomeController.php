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
        $appointements = Appointment::orderBy('id', 'DESC');
        $treatment = Treatment::orderBy('id', 'DESC');
        $visit = Visit::orderBy('id', 'DESC');
        return view('index')->with('pacients', $pacients)
                            ->with('appointements', $appointements)
                            ->with('treatment', $treatment)
                            ->with('visit', $visit);
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
