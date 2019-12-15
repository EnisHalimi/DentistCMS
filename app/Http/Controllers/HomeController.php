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

    public function index()
    {
        $pacients = Pacient::whereDate('created_at','=',date("Y-m-d"))->orderBy('id', 'DESC')->get();
        $appointements = Appointment::where('date_of_appointment','=',date("Y-m-d"))->orderBy('id', 'DESC')->get();
        $treatment = Treatment::whereDate('created_at','=',date("Y-m-d"))->orderBy('id', 'DESC')->get();
        $visit = Visit::where('date_of_visit','=',date("Y-m-d"))->orderBy('id', 'DESC')->get();
        $reports = Report::whereDate('created_at','LIKE',date("Y-m-d"))->orderBy('id', 'DESC')->get();
        return view('index')->with('pacients', $pacients)
                            ->with('appointements', $appointements)
                            ->with('treatments', $treatment)
                            ->with('reports', $reports)
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
        if(empty($settings))
        {
            DB::table('settings')->insert(
                ['app_name' => 'DentistCMS', 'logo' => 'http://maestroselectronics.com/wp-content/uploads/2017/12/No_Image_Available.jpg', 'theme' => false]
            );
            $settings = DB::table('settings')->first();
            return view('settings.settings')->with('settings', $settings);
        }
        return view('settings.settings')->with('settings', $settings);
                            
    }

    public function settingsEdit()
    {
        $settings = DB::table('settings')->first();
        if(empty($settings))
        {
            DB::table('settings')->insert(
                ['app_name' => 'DentistCMS', 'logo' => 'http://maestroselectronics.com/wp-content/uploads/2017/12/No_Image_Available.jpg', 'theme' => false]
            );
            $settings = DB::table('settings')->first();
            return view('settings.edit')->with('settings', $settings);
        }
        return view('settings.edit')->with('settings', $settings);
                            
    }

    public function settingsSave(Request $request)
    {
        $this->validate($request,[
            'app_name' =>'required',
            'logo' =>'image|nullable|max:1999',
        ]);
        $settings =  DB::table('settings')->first();
        if($request->input('theme') == 0)
            $theme = false;
        else
            $theme = true;
        if($request->hasFile('logo'))
        {
            $fileNamewithExt = $request->file('logo')->getClientOriginalName();
            $fileName = pathInfo($fileNamewithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNametoStore = $settings->app_name.'.'.$extension;
            $request->file('logo')->move(URL::to('/img'), $fileNametoStore);
            $add = DB::table('settings')->where('id', $settings->id)
            ->update(['app_name' =>  $request->input('app_name'), 'logo' => $fileNametoStore, 'theme' => $theme]);
        }
        else
        {
            $add = DB::table('settings')->where('id', $settings->id)
            ->update(['app_name' =>  $request->input('app_name'), 'theme' => $theme]);
        }
        
		
        return redirect('/settings')->with('success','U ndryshua Aranzhimi');
                            
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

    public function markAsRead(Request $request)
    {
        if($request->ajax())
        {
            $notification = Notifications::find($request->input('id'));
            $notification->opened = true;
            $notification->save();
            return response()->json(['success'=>'U markua si e lexuar.']);
        }
    }
    
}
