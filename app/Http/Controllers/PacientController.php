<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Pacient;
use App\Treatment;
use App\Appointment;
use App\Visit;
use App\Report;
use DB;

class PacientController extends Controller
{


    function getPacientDataTable()
    {
        $pacients = Pacient::select('first_name','last_name','personal_number','date_of_birth','address','residence','id');
        $table = DataTables::of($pacients)
        ->editColumn('Menaxhimi' ,'<a href="/pacient/{{$id}}" class="btn btn-circle btn-secondary "><i class="fa fa-eye"></i></a>
        <a href="/pacient/{{$id}}/edit"  class="btn btn-circle btn-primary "><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger " data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fshijModalLabel{{$id}}">A jeni i sigurtë që doni të fshini Pacientin?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <form id="form{{$id}}" class="d-inline" method="POST" action="{{ route(\'pacient.destroy\',$id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <div class="custom-control custom-checkbox small">
                                <input type="checkbox"  name="data"  class="custom-control-input" id="data">
                            <label class="custom-control-label" for="data">Fshini të dhënat e Pacientit?</label>
                              </div>
                           
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                       
                           
                            <button type="submit" form="form{{$id}}" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div> ')
        ->rawColumns(['Menaxhimi'])
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
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('pacient.pacient');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('pacient.create');
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
                'first_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'fathers_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'last_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'personal_number' => 'required|digits:10|numeric',
                'date_of_birth' => 'required|date',
                'address'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'residence'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'city'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'phone'=> 'required|min:9|numeric',
            ]);
            $pacient = new Pacient;
            $pacient->first_name = $request->input('first_name');
            $pacient->fathers_name = $request->input('fathers_name');
            $pacient->last_name = $request->input('last_name');
            $pacient->personal_number = $request->input('personal_number');
            $pacient->date_of_birth = $request->input('date_of_birth');
            $pacient->gender = $request->input('gender');
            $pacient->address = $request->input('address');
            $pacient->residence = $request->input('residence');
            $pacient->city = $request->input('city');
            $pacient->phone = $request->input('phone');
            $pacient->email = $request->input('email');
            $pacient->save();
            return redirect('/pacient')->with('success','U shtua Pacienti');
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
        $pacient = Pacient::findOrfail($id);
        $treatment = Treatment::where('pacient_id','=',$id)->get();
        $visit = Visit::where('pacient_id','=',$id)->get();
        $report = Report::where('pacient_id','=',$id)->get();
        $appointment = Appointment::where('pacient_id','=',$id)->get();
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('pacient.show')
                    ->with('pacient',$pacient)
                    ->with('treatments',$treatment)
                    ->with('visits',$visit)
                    ->with('reports',$report)
                    ->with('appointments',$appointment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pacient = Pacient::findOrfail($id);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('pacient.edit')->with('pacient',$pacient);
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
                'first_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'fathers_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'last_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'personal_number' => 'required|digits:10|numeric',
                'date_of_birth' => 'required|date',
                'address'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'residence'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'city'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'phone'=> 'required|min:9|numeric',
            ]);
            $pacient =  Pacient::find($id);
            $pacient->first_name = $request->input('first_name');
            $pacient->fathers_name = $request->input('fathers_name');
            $pacient->last_name = $request->input('last_name');
            $pacient->personal_number = $request->input('personal_number');
            $pacient->date_of_birth = $request->input('date_of_birth');
            $pacient->gender = $request->input('gender');
            $pacient->address = $request->input('address');
            $pacient->residence = $request->input('residence');
            $pacient->city = $request->input('city');
            $pacient->phone = $request->input('phone');
            $pacient->email = $request->input('email');
            $pacient->save();
            return redirect('/pacient')->with('success','U ndryshua Pacienti');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $pacient = Pacient::find($id);
        if(auth()->guest())
        {
            return redirect('/')->with('error','Unathorized Page'); 
        }
        else
        {
            if($request->input('data'))
            {
                $pacient->appointment()->delete();
                $visit = $pacient->visit()->get();
                foreach($visit as $vs)
                {
                    $treatment = $vs->treatment()->get();   
                    foreach($treatment as $tr)
                    {
                        $tr->report()->delete();
                        $tr->delete();
                    }
                }
            }
            $pacient->visit()->delete();
            $pacient->contact()->delete();
            $pacient->delete();           
            return redirect('/pacient')->with('success','Është fshirë Pacienti');
        }
    }
}
