<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Dalje;

class DaljeController extends Controller
{

    function getDaljeDataTable()
    {
        $dalje = Dalje::all();
        $table = DataTables::of($dalje)
        ->addColumn('Menaxhimi' ,'<a href="/daljet/{{$id}}" class="btn btn-circle btn-secondary "><i class="fa fa-eye"></i></a>
        <a href="/daljet/{{$id}}/edit"  class="btn btn-circle btn-primary "><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger " data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Daljen</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    A jeni i sigurtë që doni të vazhdoni?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <form class="d-inline" method="POST" action="{{ route(\'daljet.destroy\',$id)}}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div> ')
        ->editColumn('value','{{$value}} €')
        ->editColumn('bill_number','@if($bill_number == 0) Nuk ka  @else{{$bill_number}}@endif')
        ->editColumn('subject','@if($subject == "Ska") <a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$pacient_id}}"><i class="fa fa-user"></i></a>  {{App\Pacient::getPacientName($pacient_id)}} @else {{$subject}} @endif')
        ->rawColumns(['Menaxhimi','subject','bill_number'])
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
            return view('daljet.index'); 
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
            return view('daljet.create'); 
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
                'Tipi'=> 'required',
                'pacient-id' => 'required',
                'Subjekti' => 'required|string',
                'Nr_fatures' => 'required|numeric',
                'Vlera' => 'required|numeric',
                'Afati' => 'required|date',
                'Foto' =>'image|nullable|max:1999',
            ]);
          
            if($request->hasFile('Foto'))
            {
                $fileNamewithExt = $request->file('Foto')->getClientOriginalName();
                $fileName = pathInfo($fileNamewithExt, PATHINFO_FILENAME);
                $extension = $request->file('Foto')->getClientOriginalExtension();
                $date = date('d-m-Y');
                $fileNametoStore = $request->input('Tipi').'-'.$date.'.'.$extension;
                $request->file('Foto')->move(public_path('/img/faturat'), $fileNametoStore);
            }
            else
            {
                $fileNametoStore = 'no-image';
            }

            $dajle = new Dalje;
            $dajle->type = $request->input('Tipi');
            $dajle->pacient_id = $request->input('pacient-id');
            $dajle->subject = $request->input('Subjekti');
            $dajle->bill_number = $request->input('Nr_fatures');
            $dajle->deadline = $request->input('Afati');
            $dajle->value = $request->input('Vlera');
            $dajle->file = $fileNametoStore;
            $dajle->save();
            return redirect('/daljet')->with('success','U shtua dalja');
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
        $dalje = Dalje::findOrFail($id);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Nuk keni autorizim');
        else
            return view('daljet.show')->with('dalje',$dalje); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dalje = Dalje::findOrFail($id);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Nuk keni autorizim');
        else
            return view('daljet.edit')->with('dalje',$dalje); 
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
                'Tipi'=> 'required',
                'pacient-id' => 'required',
                'Subjekti' => 'required|string',
                'Nr_fatures' => 'required|numeric',
                'Vlera' => 'required|numeric',
                'Afati' => 'required|date',
                'Foto' =>'image|nullable|max:1999',
            ]);
            $dajle = Dalje::find($id);
            if($request->hasFile('Foto'))
            {
                $fileNamewithExt = $request->file('Foto')->getClientOriginalName();
                $fileName = pathInfo($fileNamewithExt, PATHINFO_FILENAME);
                $extension = $request->file('Foto')->getClientOriginalExtension();
                $date = date('d-m-Y');
                $fileNametoStore = $request->input('Tipi').'-'.$date.'.'.$extension;
                $request->file('Foto')->move(public_path('/img/faturat'), $fileNametoStore);
            }
            else
            {
                $fileNametoStore = $dajle->file;
            }
            $dajle->type = $request->input('Tipi');
            $dajle->pacient_id = $request->input('pacient-id');
            $dajle->subject = $request->input('Subjekti');
            $dajle->bill_number = $request->input('Nr_fatures');
            $dajle->deadline = $request->input('Afati');
            $dajle->value = $request->input('Vlera');
            $dajle->file = $fileNametoStore;
            $dajle->save();
            return redirect('/daljet')->with('success','U ndryshua dalja');
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
        $dalje = Dalje::find($id);
        if(auth()->guest())
        {
            return redirect('/')->with('error','Nuk keni autorizim'); 
        }
        else
        {
            $dalje->delete();           
            return redirect('/daljet')->with('success','Është fshirë Dalja');
        }
    }
}
