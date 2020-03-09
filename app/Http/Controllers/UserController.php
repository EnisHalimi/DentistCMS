<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use DataTables;

class UserController extends Controller
{

    function getUserDataTable()
    {
        $users = User::select('name','email','role_id','id','color');
        $table = DataTables::of($users)
        ->addColumn('password', '*********')
        ->addColumn('role', '{{App\Role::getRole($role_id)}}')
        ->editColumn('Menaxhimi' ,'<a href="/user/{{$id}}" class="btn btn-circle  btn-secondary"><i class="fa fa-eye"></i></a>
        <a href="/user/{{$id}}/edit"  class="btn btn-circle  btn-primary"><i class="fa fa-pen"></i></a>
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
                        <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                        <form class="d-inline" method="POST" action="{{ route(\'user.destroy\',$id)}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="DELETE">
                            <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div> ')
        ->editColumn('color', '<div class="py-2 px-4" style="background-color: {{$color}};"></div>')
        ->rawColumns(['Menaxhimi','password','color','role'])
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
        if(auth()->user()->hasPermission('view-user'))
            return view('user.users');
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
        $role = Role::all();
        if(auth()->user()->hasPermission('create-user'))
            return view('user.create')->with('roles',$role);
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
        if(auth()->user()->hasPermission('create-user'))
        {
            $this->validate($request,[
                'Emri_dhe_Mbiemri'=> 'required|min:6|string',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'role'=> 'required',
                'color'=> 'required',
            ]);
            $user = new User;
            $user->name = $request->input('Emri_dhe_Mbiemri');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->role_id = $request->input('role');
            $user->color = $request->input('color');
            $user->save();
            return redirect('/user')->with('success',__('messages.user-add'));
        }
        else
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
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
        if(auth()->user()->hasPermission('view-user'))
            return view('user.show')->with('user',$user);
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
        $role = Role::all();
        $user = User::findOrfail($id);
        if(auth()->user()->hasPermission('edit-user'))
            return view('user.edit')->with('user',$user)->with('roles',$role);
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
        if(auth()->user()->hasPermission('edit-user'))
        {
            $this->validate($request,[
                'Emri_dhe_Mbiemri'=> 'required|min:6|string',
                'email' => 'required|email',
                'password' => 'confirmed',
                'role'=> 'required',
                'color'=> 'required',
            ]);
            $user = User::find($id);
            if($request->input('password')>6)
                $user->password = Hash::make($request->input('password'));
            $user->name = $request->input('Emri_dhe_Mbiemri');
            if($user->email !== $request->input('email'))
                $user->email = $request->input('email');
            $user->role_id = $request->input('role');
            $user->color = $request->input('color');
            $user->save();
            return redirect('/user')->with('success',__('messages.user-edit'));
        }
        else
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
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
        if(auth()->user()->hasPermission('delete-user'))
        {
            $user->appointment()->delete();
            $user->visit()->delete();
            $user->delete();           
            return redirect('/user')->with('success',__('messages.user-delete'));
        }
        else
        {
            return redirect('/')->with('error',__('messages.noauthorization')); 
        }
    }
}
