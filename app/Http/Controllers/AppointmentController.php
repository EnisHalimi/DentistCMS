<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Appointment;
use App\User;
use App\Pacient;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::orderBy('date_of_appointment', 'desc')->paginate(15);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('appointment.appointment')->with('appointments', $appointments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacient = Pacient::get();
        $user = User::get();
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('appointment.create')->with('pacients',$pacient)->with('users',$user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->guest())
        {
            return redirect('/')->with('error','Unathorized Page'); 
        }
        else
        {
            $this->validate($request,[
                'pacient-id'=> 'required|numeric',
                'user-id' => 'required|numeric',
                'data' => 'required|date',
            ]);
            
            $appointment = new Appointment;
            $appointment->pacient_id = $request->input('pacient-id');
            $appointment->user_id = $request->input('user-id');
            $appointment->date_of_appointment = $request->input('data');
            $appointment->time_of_appointment = $request->input('time');
            $appointment->save();
            return redirect('/appointment')->with('success','U shtua termini');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appointments = Appointment::find($id);
        
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('appointment.show')->with('appointment', $appointments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appointments = Appointment::find($id);
        $pacient = Pacient::get();
        $user = User::get();
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('appointment.edit')->with('appointment', $appointments)->with('pacients',$pacient)->with('users',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->guest())
        {
            return redirect('/')->with('error','Unathorized Page'); 
        }
        else
        {
            $this->validate($request,[
                'pacient-id'=> 'required|numeric',
                'user-id' => 'required|numeric',
                'data' => 'required|date',
            ]);
            $appointment = Appointment::find($id);
            $appointment->pacient_id = $request->input('pacient-id');
            $appointment->user_id = $request->input('user-id');
            $appointment->date_of_appointment = $request->input('data');
            $appointment->time_of_appointment = $request->input('time');
            $appointment->save();
            return redirect('/appointment')->with('success','U ndryshua termini');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::find($id);
        if(auth()->guest())
        {
            return redirect('/')->with('error','Unathorized Page'); 
        }
        else
        {
            $appointment->delete();           
            return redirect('/appointment')->with('success','Është fshirë Termini');
        }
    }
}
