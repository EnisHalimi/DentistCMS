<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pacient;

class PacientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pacients = Pacient::orderBy('id', 'asc')->paginate(15);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('pacient.pacient')->with('pacients', $pacients);
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
            return view('pacient.create');
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
                'first_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'fathers_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'last_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'personal_number' => 'required|digits:10|numeric',
                'date_of_birth' => 'required|date',
                'address'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'residence'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'city'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
            ]);
            $pacient = new Pacient;
            $pacient->first_name = $request->input('first_name');
            $pacient->fathers_name = $request->input('fathers_name');
            $pacient->last_name = $request->input('last_name');
            $pacient->personal_number = $request->input('personal_number');
            $pacient->date_of_birth = $request->input('date_of_birth');
            $pacient->gender = $request->input('gender');
            $pacient->address = $request->input('address');
            $pacient->residence = $request->input('residence');
            $pacient->city = $request->input('city');
            $pacient->save();
            return redirect('/pacient')->with('success','U shtua Pacienti');
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
        $pacient = Pacient::findOrfail($id);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('pacient.show')->with('pacient',$pacient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pacient = Pacient::findOrfail($id);
        if(auth()->guest())
            return redirect('/login')->with('error', 'Unathorized Page');
        else
            return view('pacient.edit')->with('pacient',$pacient);
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
                'first_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'fathers_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'last_name'=> 'required|min:3|string|max:255|regex:/^[\w&.\-\s]*$/',
                'personal_number' => 'required|digits:10|numeric',
                'date_of_birth' => 'required|date',
                'address'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'residence'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
                'city'=> 'required|min:6|string|max:255|regex:/^[\w&.\-\s]*$/',
            ]);
            $pacient =  Pacient::find($id);
            $pacient->first_name = $request->input('first_name');
            $pacient->fathers_name = $request->input('fathers_name');
            $pacient->last_name = $request->input('last_name');
            $pacient->personal_number = $request->input('personal_number');
            $pacient->date_of_birth = $request->input('date_of_birth');
            $pacient->gender = $request->input('gender');
            $pacient->address = $request->input('address');
            $pacient->residence = $request->input('residence');
            $pacient->city = $request->input('city');
            $pacient->save();
            return redirect('/pacient')->with('success','U ndryshua Pacienti');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,Request $request)
    {
        $pacient = Pacient::find($id);
        if(auth()->guest())
        {
            return redirect('/')->with('error','Unathorized Page'); 
        }
        else
        {
            if($request->input('data'))
            {
                $pacient->appointment()->delete();
                $visit = $pacient->visit()->get();
                foreach($visit as $vs)
                {
                    $treatment = $vs->treatment()->get();   
                    foreach($treatment as $tr)
                    {
                        $tr->report()->delete();
                        $tr->delete();
                    }
                }
            }
            $pacient->visit()->delete();
            $pacient->contact()->delete();
            $pacient->delete();           
            return redirect('/pacient')->with('success','Është fshirë Pacienti');
        }
    }
}
