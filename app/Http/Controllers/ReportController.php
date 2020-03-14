<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use App\Pacient;
use App\Treatment;
use App\User;
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
        <form method="GET" action="{{ url(\'raporti\') }}" class="d-inline form-inline">
        <input id="id" hidden name="id" value="{{$id}}"/>
      <button type="submit" class="btn btn-circle btn-success "><i class="fa fa-print"></i></button>
      </form>')
        ->editColumn('pacient_id',' <a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$pacient_id}}"><i class="fa fa-user"></i></a> {{App\Pacient::getPacient($pacient_id)}}')
        ->editColumn('user_id',' <a class="btn btn-circle btn-secondary btn-sm" href="/user/{{$user_id}}"><i class="fa fa-user-md"></i></a> {{App\User::getUser($user_id)}}')
        ->rawColumns(['Menaxhimi','pacient_id','user_id'])
        ->make(true);
        return $table;
    }

    public function raporti(Request $request)
    {
        $report = Report::find($request->input('id'));
        $pacient = Pacient::find($report->pacient_id);
        $user = User::find($report->user_id);
        $treatments = Treatment::where('pacient_id','=', $pacient->id)->get();
        $data['treatments'] = $treatments;
        $data['pacient'] = $pacient;
        $data['report'] = $report;
        $data['user'] = $user;
        $pdf = PDF::loadView('report.raport', $data);
        return $pdf->stream('Raporti-'.$report->id.'.pdf');
       }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->hasPermission('view-report'))
            return redirect('/')->with('error', __('messages.noauthorization'));
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
        if(!auth()->user()->hasPermission('create-report'))
            return redirect('/')->with('error', __('messages.noauthorization'));
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
        if(!auth()->user()->hasPermission('create-report'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $this->validate($request,[
                'user-id'=> 'required',
                'pacient-id' => 'required',
                'complaint' => 'required|min:3',
                'evaluation' => 'required|min:3',
                'diagnosis' => 'required|min:3',
                'recommendation' => 'required|min:3',
            ]);
            
            $report = new Report;
            $report->user_id = $request->input('user-id');
            $report->complaint = $request->input('complaint');
            $report->evaluation = $request->input('evaluation');
            $report->diagnosis = $request->input('diagnosis');
            $report->recommendation = $request->input('recommendation');
            $report->pacient_id = $request->input('pacient-id');
            $report->save();
            return redirect('/report')->with('success',__('messages.report-add'));
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
        $user = User::find($report->user_id);
        $treatments = Treatment::where('pacient_id','=', $pacient->id)->get();
        if(!auth()->user()->hasPermission('view-report'))
        return redirect('/')->with('error', __('messages.noauthorization'));
            else
        return view('report.show')->with('report',$report)->with('pacient',$pacient)->with('treatments',$treatments)->with('user',$user);
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
        if(!auth()->user()->hasPermission('edit-report'))
            return redirect('/login')->with('error', __('messages.noauthorization'));
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
        if(!auth()->user()->hasPermission('edit-report'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $this->validate($request,[
                'user-id'=> 'required',
                'pacient-id' => 'required',
                'complaint' => 'required|min:3',
                'evaluation' => 'required|min:3',
                'diagnosis' => 'required|min:3',
                'recommendation' => 'required|min:3',
            ]);
            $report = Report::find($id);
            $report->user_id = $request->input('user-id');
            $report->complaint = $request->input('complaint');
            $report->evaluation = $request->input('evaluation');
            $report->diagnosis = $request->input('diagnosis');
            $report->recommendation = $request->input('recommendation');
            $report->pacient_id = $request->input('pacient-id');
            $report->save();
            return redirect('/report')->with('success',__('messages.report-edit'));
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
        if(!auth()->user()->hasPermission('delete-report'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $report->delete();           
            return redirect('/report')->with('success',__('message.report-delete'));
        }   
    }
}
