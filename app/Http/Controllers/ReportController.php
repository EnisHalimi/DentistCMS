<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Pacient;
use App\Treatment;
use PDF;
use DB;
use DataTables;


class ReportController extends Controller
{


    function getReportDataTable()
    {
        $reports = Report::all();
      
        $table = DataTables::of($reports)
        ->editColumn('Menaxhimi' ,'<a href="/report/{{$id}}" class="btn btn-circle btn-secondary "><i class="fa fa-eye"></i></a>
        <a href="/report/{{$id}}/edit"  class="btn btn-circle btn-primary "><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger " data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Raportin?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        A jeni i sigurtë që doni të vazhdoni?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <form class="d-inline" method="POST" action="{{ route(\'report.destroy\',$id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div> 
        <form method="GET" action="{{ url(\'pdf\') }}" class="d-inline form-inline">
        <input id="id" hidden name="id" value="{{$id}}"/>
      <button type="submit" class="btn btn-circle btn-success "><i class="fa fa-print"></i></button>
      </form>')
        ->editColumn('pacient_id',' <a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($pacient_id)}}')
        ->editColumn('starting_date',' <a class="btn btn-circle btn-secondary btn-sm" href="/treatment/{{$treatment_id}}"><i class="fa fa-syringe"></i></a> {{App\Treatment::getStartingDate($treatment_id)}}')
        ->rawColumns(['Menaxhimi','pacient_id','starting_date'])
        ->make(true);
        return $table;
    }

    public function pdf(Request $request)
    {
        $report = Report::find($request->input('id'));
        $pacient = Pacient::find($report->pacient_id);
        $treatment = Treatment::find($report->treatment_id);
        $services = $treatment->services()->get();
        $data['pacient'] = $pacient;
        $data['report'] = $report;
        $data['services'] = $services;
        $pdf = PDF::loadView('report.download', $data);
        return $pdf->stream('Fatura-'.$report->id.'.pdf');
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
        return view('report.report');
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
        return view('report.create');
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
                'treatment-id'=> 'required',
                'pacient-id' => 'required',
                'Pershkrimi' => 'required|min:5',
            ]);
            
            $report = new Report;
            $report->treatment_id = $request->input('treatment-id');
            $report->pacient_id = $request->input('pacient-id');
            $report->description = $request->input('Pershkrimi');
            $report->save();
            return redirect('/report')->with('success','U shtua raporti');
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
        $report = Report::find($id);
        $pacient = Pacient::find($report->pacient_id);
        $treatment = Treatment::find($report->treatment_id);
        $services = $treatment->services()->get();
        if(auth()->guest())
        return redirect('/login')->with('error', 'Nuk keni autorizim');
            else
        return view('report.show')->with('report',$report)->with('pacient',$pacient)->with('services',$services);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Nuk keni autorizim');
        else
            return view('report.edit')->with('report',$report);
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
                'treatment-id'=> 'required',
                'pacient-id' => 'required',
                'Pershkrimi' => 'required|min:5',
            ]);
            
            $report = Report::find($id);
            $report->treatment_id = $request->input('treatment-id');
            $report->pacient_id = $request->input('pacient-id');
            $report->description = $request->input('Pershkrimi');
            $report->save();
            return redirect('/report')->with('success','U ndryshua raporti');
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
        $report = Report::find($id);
        if(auth()->guest())
        {
            return redirect('/')->with('error','Nuk keni autorizim'); 
        }
        else
        {
            $report->delete();           
            return redirect('/report')->with('success','Është fshirë Raporti');
        }
    }
}
