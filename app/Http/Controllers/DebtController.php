<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Debt;
use App\Pacient;
use App\Notifications;


class DebtController extends Controller
{       

    function getDebtDataTable()
    {
        $debt = Debt::all();
        $table = DataTables::of($debt)
        ->addColumn('Menaxhimi' ,'<a href="/debt/{{$id}}" class="btn btn-circle btn-secondary "><i class="fa fa-eye"></i></a>
        <a href="/debt/{{$id}}/edit"  class="btn btn-circle btn-primary "><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger " data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Borgjin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    A jeni i sigurtë që doni të vazhdoni?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <form class="d-inline" method="POST" action="{{ route(\'debt.destroy\',$id)}}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div> ')
        ->editColumn('value','{{$value}} €')
        ->editColumn('pacient','<a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$pacient_id}}"><i class="fa fa-user"></i></a>  {{App\Pacient::getPacientName($pacient_id)}}')
        ->rawColumns(['Menaxhimi','pacient','bill_number'])
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
        if(!auth()->user()->hasPermission('view-debt'))
            return redirect('/')->with('error', __('messages.noauthorization'));
        else
            return view('debt.index'); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->hasPermission('create-debt'))
            return redirect('/')->with('error', __('messages.noauthorization'));
        else
            return view('debt.create'); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create-debt'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $this->validate($request,[
                'pacient-id' => 'required',
                'Vlera' => 'required|numeric',
                'Afati' => 'required|date',
            ]);
            $debt = new Debt;
            $debt->pacient_id = $request->input('pacient-id');
            $debt->deadline = $request->input('Afati');
            $debt->value = $request->input('Vlera');
            $debt->save();
            $pacient = Pacient::find($request->input('pacient-id'));
            $notifications = new Notifications;
            $notifications->description = $pacient->first_name.' '.$pacient->last_name.' borgji ka afat deri në datën: '.$request->input('Afati').'.';
            $notifications->type = 'Debt-'.$debt->id;
            $notifications->date = $request->input('Afati');
            $notifications->opened = false;
            $notifications->save();
            return redirect('/debt')->with('success',__('messages.debt-add'));
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
        $debt = Debt::findOrFail($id);
        if(!auth()->user()->hasPermission('view-debt'))
            return redirect('/login')->with('error', __('messages.noauthorization'));
        else
            return view('debt.show')->with('debt',$debt); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $debt = Debt::findOrFail($id);
        if(!auth()->user()->hasPermission('edit-debt'))
            return redirect('/login')->with('error', __('messages.noauthorization'));
        else
            return view('debt.edit')->with('debt',$debt); 
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
        if(!auth()->user()->hasPermission('edit-debt'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $this->validate($request,[
                'pacient-id' => 'required',
                'Vlera' => 'required|numeric',
                'Afati' => 'required|date',
            ]);
            $notifications = Notifications::where('type','=','Debt-'.$id)->first();
            $pacient = Pacient::find($request->input('pacient-id'));
            $debt = Debt::find($id);
            $debt->pacient_id = $request->input('pacient-id');
            $debt->deadline = $request->input('Afati');
            $debt->value = $request->input('Vlera');
            $debt->save();
            if(!empty($notifications))
            {
                $notifications->description = $pacient->first_name.' '.$pacient->last_name.' borgji ka afat deri në datën: '.$request->input('Afati').'.';
                $notifications->date = $request->input('Afati');
                $notifications->opened = false;
                $notifications->save();
            }
            else{
                $notifications = new Notifications;
                $notifications->description = $pacient->first_name.' '.$pacient->last_name.' borgji ka afat deri në datën: '.$request->input('Afati').'.';
                $notifications->type = 'Debt-'.$debt->id;
                $notifications->date = $request->input('Afati');
                $notifications->opened = false;
                $notifications->save();
            }
           
            return redirect('/debt')->with('success',__('messages.debt-edit'));
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
        $debt = Debt::find($id);
        if(!auth()->user()->hasPermission('delete-debt'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $notifications = Notifications::where('type','=','Debt-'.$debt->id)->first();
            if(!empty($notifications))
            {   
                $notifications->delete();
            }
            $debt->delete();           
            return redirect('/debt')->with('success',__('messages.debt-delete'));
        }
    }
}
