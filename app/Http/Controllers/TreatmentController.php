<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Treatment;
use DataTables;

class TreatmentController extends Controller
{

    function getTreatmentDataTable()
    {
        $treatment = DB::table('treatments')
        ->join('visits', 'visits.id', '=', 'treatments.visit_id')
        ->join('pacients', 'pacients.id', '=', 'visits.pacient_id')
        ->select('treatments.*','pacients.first_name','pacients.last_name')
        ->get();
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                    <form class="d-inline" method="POST" action="{{ route(\'treatment.destroy\',$id)}}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Fshij</button>
                    </form>
                    
                </div>
                </div>
            </div>
        </div> ')
        ->editColumn('visit_id','<a class="btn btn-circle btn-secondary btn-sm" href="/visit/{{$visit_id}}"><i class="fa fa-eye"></i></a> {{$first_name}}  {{$last_name}} ')
        ->rawColumns(['Menaxhimi','visit_id'])
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
        $visits = DB::table('visits')
                        ->join('users', 'users.id', '=', 'visits.user_id')
                        ->join('pacients', 'pacients.id', '=', 'visits.pacient_id')
                        ->select('visits.*', 'users.name', 'pacients.first_name', 'pacients.last_name', 'pacients.personal_number')
                        ->get();
        $users = User::get();
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('treatment.create')->with('visits',$visits)->with('users',$users);
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
                'visit-id'=> 'required|numeric',
                'type_of_treatment' => 'required|min:3',
                'duration' => 'required|min:3',
            ]);
            
            $treatment = new Treatment;
            $treatment->visit_id = $request->input('visit-id');
            $treatment->type_of_treatment = $request->input('type_of_treatment');
            $treatment->duration = $request->input('duration');
            $treatment->save();
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
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('treatment.show')->with('treatment',$treatment);
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
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('treatment.edit')->with('treatment',$treatment);
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
                'visit-id'=> 'required|numeric',
                'type_of_treatment' => 'required|min:3',
                'duration' => 'required|min:3',
            ]);
            
            $treatment = Treatment::find($id);
            $treatment->visit_id = $request->input('visit-id');
            $treatment->type_of_treatment = $request->input('type_of_treatment');
            $treatment->duration = $request->input('duration');
            $treatment->save();
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
            $treatment->delete();           
            return redirect('/treatment')->with('success','Është fshirë Trajtimi');
        }
    }
}
