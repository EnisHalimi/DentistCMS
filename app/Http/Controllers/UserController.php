<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use DataTables;

class UserController extends Controller
{

    function getUserDataTable()
    {
        $users = User::select('name','email','position','id');
        $table = DataTables::of($users)
        ->addColumn('password', '*********')
        ->editColumn('Menaxhimi' ,'<a href="/user/{{$id}}" class="btn btn-circle  btn-secondary"><i class="fa fa-eye"></i></a>
        <a href="/user/{{$id}}/edit"  class="btn btn-circle  btn-info"><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle  btn-danger" data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Përdoruesin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        A jeni i sigurtë që doni të vazhdoni?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                        <form class="d-inline" method="POST" action="{{ route(\'user.destroy\',$id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i> Fshij</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div> ')
        ->rawColumns(['Menaxhimi','password'])
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
            return view('user.users');
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
            return view('user.create');
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
                'name'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'email' => 'required|min:6|string|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'position'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
            ]);
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->position = $request->input('position');
            $user->save();
            return redirect('/user')->with('success','U shtua Përdoruesi');
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
        $user = User::findOrfail($id);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('user.show')->with('user',$user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrfail($id);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('user.edit')->with('user',$user);
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
                'name'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'email' => 'required|min:6|string',
                'password' => 'confirmed',
                'position'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
            ]);
            $user = User::find($id);
            if($request->input('password')>6)
                $user->password = Hash::make($request->input('password'));
            $user->name = $request->input('name');
            if($user->email !== $request->input('email'))
                $user->email = $request->input('email');
            $user->position = $request->input('position');
            $user->save();
            return redirect('/user')->with('success','U ndryshua Përdoruesi');
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
        $user = User::find($id);
        if(auth()->guest())
        {
            return redirect('/')->with('error','Unathorized Page'); 
        }
        else
        {
            $user->delete();           
            return redirect('/user')->with('success','Është fshirë Përdoruesi');
        }
    }
}
