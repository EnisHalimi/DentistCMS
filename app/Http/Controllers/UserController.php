<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->paginate(15);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('user.users')->with('users', $users);
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
