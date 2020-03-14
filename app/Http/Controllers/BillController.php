<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Bill;
use App\Notifications;
use DataTables;

class BillController extends Controller
{

    function getBillDataTable()
    {
        $bill = Bill::all();
        $table = DataTables::of($bill)
        ->addColumn('Menaxhimi' ,'<a href="/bill/{{$id}}" class="btn btn-circle btn-secondary "><i class="fa fa-eye"></i></a>
        <a href="/bill/{{$id}}/edit"  class="btn btn-circle btn-primary "><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger " data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Shpenzimin</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    A jeni i sigurtë që doni të vazhdoni?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <form class="d-inline" method="POST" action="{{ route(\'bill.destroy\',$id)}}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div> ')
        ->editColumn('value','{{$value}} €')
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
        if(auth()->user()->hasPermission('view-bill'))
            return view('bill.bill');
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->user()->hasPermission('create-bill'))
            return view('bill.create');
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('create-bill'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $this->validate($request,[
                'subject' => 'required|min:3',
                'bill-nr' => 'required|min:3',
                'Vlera' => 'required|numeric',
                'Afati' => 'required|date',
                'Foto' =>'image|nullable|max:1999',
            ]);
            if($request->hasFile('Foto'))
            {
                $fileNamewithExt = $request->file('Foto')->getClientOriginalName();
                $fileName = pathInfo($fileNamewithExt, PATHINFO_FILENAME);
                $extension = $request->file('Foto')->getClientOriginalExtension();
                $date = date('d-m-Y H:m:s');
                $fileNametoStore = 'Fatura-'.$date.'.'.$extension;
                $request->file('Foto')->move(public_path('img/faturat'), $fileNametoStore);
            }
            else
            {
                $fileNametoStore = 'no-image';
            }
            
            $bill = new Bill;
            $bill->subject = $request->input('subject');
            $bill->bill_nr = $request->input('bill-nr');
            $bill->deadline = $request->input('Afati');
            $bill->value = $request->input('Vlera');
            $bill->file = $fileNametoStore;
            $bill->save();
            $notifications = new Notifications;
            $notifications->description = $request->input('subject').' Fatura ka afat deri në datën: '.$request->input('Afati').'.';
            $notifications->type = 'Bill-'.$bill->id;
            $notifications->date = $request->input('Afati');
            $notifications->opened = false;
            $notifications->save();
            return redirect('/bill')->with('success',__('messages.bill-add'));
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
        $bill = Bill::find($id);
        if(auth()->user()->hasPermission('view-bill'))
            return view('bill.show')->with('bill',$bill);
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bill = Bill::find($id);
        if(auth()->user()->hasPermission('edit-bill'))
            return view('bill.edit')->with('bill',$bill);
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
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
        if(!auth()->user()->hasPermission('create-bill'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $this->validate($request,[
                'subject' => 'required|min:3',
                'bill-nr' => 'required|min:3',
                'Vlera' => 'required|numeric',
                'Afati' => 'required|date',
                'Foto' =>'image|nullable|max:1999',
            ]);
            $bill =  Bill::find($id);
            $notifications = Notifications::where('type','=','Bill-'.$id)->first();
            if($request->hasFile('Foto'))
            {
                $fileNamewithExt = $request->file('Foto')->getClientOriginalName();
                $fileName = pathInfo($fileNamewithExt, PATHINFO_FILENAME);
                $extension = $request->file('Foto')->getClientOriginalExtension();
                $date = date('d-m-Y H:m:s');
                $fileNametoStore = 'Fatura-'.$date.'.'.$extension;
                $request->file('Foto')->move(public_path('img/faturat'), $fileNametoStore);
                $bill->file =  $fileNametoStore;
            }
            $bill->subject = $request->input('subject');
            $bill->bill_nr = $request->input('bill-nr');
            $bill->deadline = $request->input('Afati');
            $bill->value = $request->input('Vlera');
            $bill->save();
            if(!empty($notifications))
            {
                $notifications->description = $request->input('subject').' Fatura ka afat deri në datën: '.$request->input('Afati').'.';
                $notifications->date = $request->input('Afati');
                $notifications->opened = false;
                $notifications->save();
            }
            else{
                $notifications = new Notifications;
                $notifications->description = $request->input('subject').' Fatura ka afat deri në datën: '.$request->input('Afati').'.';
                $notifications->type = 'Debt-'.$debt->id;
                $notifications->date = $request->input('Afati');
                $notifications->opened = false;
                $notifications->save();
            }
            return redirect('/bill')->with('success',__('messages.bill-edit'));
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
        $bill = Bill::find($id);
        if(!auth()->user()->hasPermission('delete-bill'))
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $notifications = Notifications::where('type','=','Bill-'.$bill->id)->first();
            if(!empty($notifications))
            {   
                $notifications->delete();
            }
            $bill->delete();           
            return redirect('/bill')->with('success',__('messages.bill-delete'));
        }
    }
}
