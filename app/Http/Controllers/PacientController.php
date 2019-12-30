<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Pacient;
use App\Treatment;
use App\Appointment;
use App\Visit;
use App\Report;
use App\Dalje;
use DB;

class PacientController extends Controller
{


    function getPacientDataTable()
    {
        $pacients = Pacient::all();
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
            return redirect('/login')->with('error', 'Nuk keni autorizim');
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
            return redirect('/login')->with('error', 'Nuk keni autorizim');
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
            return redirect('/')->with('error','Nuk keni autorizim'); 
        }
        else
        {
            $this->validate($request,[  
                'Emri'=> 'required|alpha|min:3',
                'Emri_Prindit'=> 'required|alpha|min:3',
                'Mbiemri'=> 'required|alpha|min:3',
                'Numri_Personal' => 'required|digits:10|numeric',
                'Data_e_lindjes' => 'required|date',
                'Adresa'=> 'required|min:2',
                'Vendbanimi'=> 'required|min:2',
                'Qyteti'=> 'required|min:2',
                'Telefoni'=> 'required|min:9|numeric',
            ]);
            $pacient = new Pacient;
            $pacient->first_name = $request->input('Emri');
            $pacient->fathers_name = $request->input('Emri_Prindit');
            $pacient->last_name = $request->input('Mbiemri');
            $pacient->personal_number = $request->input('Numri_Personal');
            $pacient->date_of_birth = $request->input('Data_e_lindjes');
            $pacient->gender = $request->input('gender');
            $pacient->address = $request->input('Adresa');
            $pacient->residence = $request->input('Vendbanimi');
            $pacient->city = $request->input('Qyteti');
            $pacient->phone = $request->input('Telefoni');
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
        $dalje = Dalje::where('pacient_id','=',$id)->get();
        $appointment = Appointment::where('pacient_id','=',$id)->get();
        if(auth()->guest())
            return redirect('/login')->with('error', 'Nuk keni autorizim');
        else
            return view('pacient.show')
                    ->with('pacient',$pacient)
                    ->with('treatments',$treatment)
                    ->with('visits',$visit)
                    ->with('reports',$report)
                    ->with('daljet',$dalje)
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
            return redirect('/login')->with('error', 'Nuk keni autorizim');
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
            return redirect('/')->with('error','Nuk keni autorizim'); 
        }
        else
        {
            $this->validate($request,[
                'Emri'=> 'required|alpha|min:3',
                'Emri_Prindit'=> 'required|alpha|min:3',
                'Mbiemri'=> 'required|alpha|min:3',
                'Numri_Personal' => 'required|digits:10|numeric',
                'Data_e_lindjes' => 'required|date',
                'Adresa'=> 'required|min:2',
                'Vendbanimi'=> 'required|min:2',
                'Qyteti'=> 'required|min:2',
                'Telefoni'=> 'required|min:9|numeric',
            ]);
            $pacient =  Pacient::find($id);
            $pacient->first_name = $request->input('Emri');
            $pacient->fathers_name = $request->input('Emri_Prindit');
            $pacient->last_name = $request->input('Mbiemri');
            $pacient->personal_number = $request->input('Numri_Personal');
            $pacient->date_of_birth = $request->input('Data_e_lindjes');
            $pacient->gender = $request->input('gender');
            $pacient->address = $request->input('Adresa');
            $pacient->residence = $request->input('Vendbanimi');
            $pacient->city = $request->input('Qyteti');
            $pacient->phone = $request->input('Telefoni');
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
            return redirect('/')->with('error','Nuk keni autorizim'); 
        }
        else
        {
            if($request->input('data'))
            {
                $pacient->appointment()->delete();
                $pacient->visit()->delete();
                $treatment = $pacient->treatment()->get();   
                    foreach($treatment as $tr)
                    {
                        $tr->report()->delete();
                        $tr->services()->detach();
                        $tr->delete();   
                    }

            }
            $pacient->delete();           
            return redirect('/pacient')->with('success','Është fshirë Pacienti');
        }
    }
}
