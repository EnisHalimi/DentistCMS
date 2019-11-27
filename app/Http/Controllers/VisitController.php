<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Pacient;
use App\User;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visits = Visit::orderBy('date_of_visit', 'desc')->paginate(15);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('visit.visit')->with('visits',$visits);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pacient = Pacient::get();
        $user = User::get();
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('visit.create')->with('pacients',$pacient)->with('users',$user);
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
                'pacient-id'=> 'required|numeric',
                'user-id' => 'required|numeric',
                'data' => 'required|date',
            ]);
            
            $visit = new Visit;
            $visit->pacient_id = $request->input('pacient-id');
            $visit->user_id = $request->input('user-id');
            $visit->date_of_visit = $request->input('data');
            $visit->time_of_visit = $request->input('time');
            $visit->save();
            return redirect('/visit')->with('success','U shtua vizita');
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
        $visit = Visit::find($id);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('visit.show')->with('visit', $visit);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $visit = Visit::find($id);
        $pacient = Pacient::get();
        $user = User::get();
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('visit.edit')->with('visit', $visit)->with('pacients',$pacient)->with('users',$user);
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
                'pacient-id'=> 'required|numeric',
                'user-id' => 'required|numeric',
                'data' => 'required|date',
            ]);
            
            $visit = Visit::find($id);
            $visit->pacient_id = $request->input('pacient-id');
            $visit->user_id = $request->input('user-id');
            $visit->date_of_visit = $request->input('data');
            $visit->time_of_visit = $request->input('time');
            $visit->save();
            return redirect('/visit')->with('success','U ndryshua vizita');
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
        $visit = Visit::find($id);
        if(auth()->guest())
        {
            return redirect('/')->with('error','Unathorized Page'); 
        }
        else
        {
            $visit->delete();           
            return redirect('/visit')->with('success','Është fshirë Vizita');
        }
    }
}
