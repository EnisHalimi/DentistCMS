<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use DB;
use App\Appointment;
use App\User;
use App\Pacient;

class AppointmentController extends Controller
{

    function getAppointmentDataTable()
    {
        $appointments = DB::table('appointments')
                        ->join('users', 'users.id', '=', 'appointments.user_id')
                        ->join('pacients', 'pacients.id', '=', 'appointments.pacient_id')
                        ->select('appointments.*', 'users.name', 'pacients.first_name', 'pacients.last_name', 'pacients.personal_number')
                        ->get();
        $table = DataTables::of($appointments)
        ->addColumn('Menaxhimi' ,'<a href="/appointment/{{$id}}" class="btn btn-circle btn-secondary"><i class="fa fa-eye"></i></a>
        <a href="/appointment/{{$id}}/edit"  class="btn btn-circle btn-info"><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger" data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Përdoruesin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        A jeni i sigurtë që doni të vazhdoni?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                        <form class="d-inline" method="POST" action="{{ route(\'appointment.destroy\',$id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Fshij</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div> ')
        ->editColumn('pacient_id',' <a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$pacient_id}}"><i class="fa fa-user"></i></a> {{$first_name}}  {{$last_name}}  {{$personal_number}}')
        ->editColumn('user_id',' <a class="btn btn-circle btn-secondary btn-sm" href="/user/{{$user_id}}"><i class="fa fa-user-md"></i></a> {{$name}}')
        ->rawColumns(['Menaxhimi','pacient_id','user_id'])
        ->make(true);
        return $table;
    }
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
        $pacient = Pacient::orderBy('id', 'desc')->paginate(15);
        $user = User::orderBy('id', 'desc')->paginate(15);
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
