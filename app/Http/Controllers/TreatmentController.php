<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Treatment;
use App\Services;
use DataTables;

class TreatmentController extends Controller
{

    function getTreatmentDataTable()
    {
        $treatment = Treatment::all();
        $table = DataTables::of($treatment)
        ->addColumn('Menaxhimi' ,'<a href="/treatment/{{$id}}" class="btn btn-circle btn-secondary "><i class="fa fa-eye"></i></a>
        <a href="/treatment/{{$id}}/edit"  class="btn btn-circle btn-primary "><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger " data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Trajtimin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    A jeni i sigurtë që doni të vazhdoni?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <form class="d-inline" method="POST" action="{{ route(\'treatment.destroy\',$id)}}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn  btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                    
                </div>
                </div>
            </div>
        </div> ')
        ->editColumn('pacient_id','<a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacientName($pacient_id)}} ')
        ->rawColumns(['Menaxhimi','pacient_id'])
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
        return view('treatment.treatment');
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
            return view('treatment.create');
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
                'starting_date' => 'required|date',
                'duration' => 'required|min:3',
                'service-list' => 'required',
            ]);
            
            $treatment = new Treatment;
            $treatment->pacient_id = $request->input('pacient-id');
            $treatment->starting_date = $request->input('starting_date');
            $treatment->duration = $request->input('duration');
            $services  = explode(",",$request->input('service-list'));
            $treatment->save();
            foreach($services as $service)
            {
                if($service !== ' ')
                {   
                    $temp = Services::find($service);
                    $treatment->services()->attach($temp);
                }
              
            }
            return redirect('/treatment')->with('success','U shtua trajtimi');
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
        $treatment = Treatment::find($id);
        $services = $treatment->services()->where('treatment_id','=',$id)->get();
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('treatment.show')->with('treatment',$treatment)->with('services',$services);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $treatment = Treatment::find($id);
        $services_id = $treatment->services()->where('treatment_id','=',$id)->select('services_id')->get();
        $services = $treatment->services()->where('treatment_id','=',$id)->get();
        
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('treatment.edit')->with('treatment',$treatment)->with('services_id',$services_id)->with('services',$services);;
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
                'starting_date' => 'required|date',
                'duration' => 'required|min:3',
                'service-list' => 'required',
            ]);
            
            $treatment = Treatment::find($id);
            $treatment->pacient_id = $request->input('pacient-id');
            $treatment->starting_date = $request->input('starting_date');
            $treatment->duration = $request->input('duration');
            $services  = explode(",",$request->input('service-list'));
            $treatment->save();
            $treatment->services()->detach();
            foreach($services as $service)
            {
                if($service !== ' ')
                {   
                    $temp = Services::find($service);
                    $treatment->services()->attach($temp);
                }
              
            }
            return redirect('/treatment')->with('success','U ndryshua trajtimi');
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
        
        $treatment = Treatment::find($id);
        if(auth()->guest())
        {
            return redirect('/')->with('error','Unathorized Page'); 
        }
        else
        {
            $treatment->services()->detach();
            $treatment->delete();           
            return redirect('/treatment')->with('success','Është fshirë Trajtimi');
        }
    }
}
