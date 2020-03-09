<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services;
use DataTables;

class ServicesController extends Controller
{
    function getServiceDataTable()
    {
        $service = Services::get();
        $table = DataTables::of($service)
        ->addColumn('Menaxhimi' ,'<a href="/services/{{$id}}" class="btn btn-circle btn-secondary "><i class="fa fa-eye"></i></a>
        <a href="/services/{{$id}}/edit"  class="btn btn-circle btn-primary "><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger " data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Shërbimin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    A jeni i sigurtë që doni të vazhdoni?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <form class="d-inline" method="POST" action="{{ route(\'services.destroy\',$id)}}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                    </form>
                    
                </div>
                </div>
            </div>
        </div> ')
        ->editColumn('discount','{{$discount}} %')
        ->editColumn('price','{{$price}} €')
        ->rawColumns(['Menaxhimi'])
        ->make(true);
        return $table;
    }

    public function index()
    {
        if(auth()->guest())
            return redirect('/login')->with('error', __('messages.noauthorization'));
        else
            return view('service.service');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->guest())
        return redirect('/login')->with('error', __('messages.noauthorization'));
    else
        return view('service.create');
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
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $this->validate($request,[
                'Sherbimi'=> 'required|min:6|string',
                'Qmimi' => 'required|numeric',
                'discount' => 'required|numeric',
            ]);
            
            $service = new Services;
            $service->name = $request->input('Sherbimi');
            $service->price = $request->input('Qmimi');
            $service->discount = $request->input('discount');
            $service->save();
            return redirect('/services')->with('success','U shtua shërbimi');
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
        $service = Services::find($id);
        if(auth()->guest())
            return redirect('/login')->with('error', __('messages.noauthorization'));
        else
            return view('service.show')->with('service',$service);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Services::find($id);
        if(auth()->guest())
            return redirect('/login')->with('error', __('messages.noauthorization'));
        else
            return view('service.edit')->with('service',$service);
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
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $this->validate($request,[
                'Sherbimi'=> 'required|min:6|string',
                'Qmimi' => 'required|numeric',
                'discount' => 'required|numeric',
            ]);
            
            $service = Services::find($id);
            $service->name = $request->input('Sherbimi');
            $service->price = $request->input('Qmimi');
            $service->discount = $request->input('discount');
            $service->save();
            return redirect('/services')->with('success','U ndryshua shërbimi');
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
         
        $service = Services::find($id);
        if(auth()->guest())
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
        else
        {
            $service->delete();           
            return redirect('/services')->with('success','Është fshirë Shërbimi');
        }
    }
}
