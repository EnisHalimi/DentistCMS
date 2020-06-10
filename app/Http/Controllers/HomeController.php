<?php

namespace App\Http\Controllers;

use Spatie\DbDumper\Databases\MySql;
use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use App\Treatment;
use App\Pacient;
use App\Report;
use App\Services;
use App\Visit;
use App\Contact;
use App\Debt;
use App\Bill;
use App\Payment;
use App\Notifications;
use DataTables;
use DB;
use Carbon\Carbon;
use Cart;
use Redirect,Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $pacients = Pacient::whereDate('created_at','=',date("Y-m-d"))->orderBy('id', 'DESC')->get();
        $appointements = Appointment::whereBetween('date_of_appointment',[Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $treatment = Treatment::whereDate('created_at','=',date("Y-m-d"))->orderBy('id', 'DESC')->get();
        $visit = Visit::where('date_of_visit','=',date("Y-m-d"))->orderBy('id', 'DESC')->get();
        $reports = Report::whereDate('created_at','LIKE',date("Y-m-d"))->orderBy('id', 'DESC')->get();
        return view('index')->with('pacients', $pacients)
                            ->with('appointements', $appointements)
                            ->with('treatments', $treatment)
                            ->with('reports', $reports)
                            ->with('visits', $visit);
    }
    public function autocomplete()
    {
        $pacients = Pacient::orderBy('id', 'ASC')->get();
        foreach($pacients as $pacient)
        {
            $list[]= "$pacient->first_name $pacient->last_name $pacient->personal_number,$pacient->id";
        }
        return response()->json($list);
    }

    public function notifications()
    {
        $notifications = Notifications::orderBy('created_at', 'DESC');
        return view('notifications')->with('notifications', $notifications);

    }

    public function calendar()
    {
        $users = User::where('role_id','=',0)->orWhere('role_id','=',1)->get();
        return view('calendar')->with('users',$users);

    }

    public function daily(Request $request)
    {
        if(empty($request->input('date')))
            $date = date('Y-m-d');
        else
            $date = $request->input('date');
        $pacients = Pacient::whereDate('created_at','=',$date)->get();
        $appointements = Appointment::whereDate('date_of_appointment','=',$date)->get();
        $treatment = Treatment::whereDate('starting_date','=',$date)->get();
        $visit = Visit::whereDate('date_of_visit','=',$date)->get();
        $reports = Report::whereDate('created_at','=',$date)->get();
        $debt = Debt::whereDate('created_at','=',$date)->get();
        $payment = Payment::whereDate('created_at','=',$date)->get();
        $bill = Bill::whereDate('created_at','=',$date)->get();
        return view('daily')->with('pacients',$pacients)
        ->with('appointements',$appointements)
        ->with('treatment',$treatment)
        ->with('visit',$visit)
        ->with('reports',$reports)
        ->with('debt',$debt)
        ->with('bill',$bill)
        ->with('date', $date)
        ->with('payment',$payment);
    }

    public function company()
    {
        $company = DB::table('company')->first();
        return view('company.company')->with('company', $company);

    }

    public function backup()
    {
        $file_name = public_path('Metropolis_' . date('Y_m_d', time()) . '.sql');
        MySql::create()
        ->setDbName('homestead')
        ->setUserName('homestead')
        ->setPassword('secret')
        ->dumpToFile($file_name);
        $headers = array(
            'Content-Type: application/octet-stream',
          );
        return Response::download($file_name, 'Metropolis_' . date('Y_m_d', time()) . '.sql', $headers)->deleteFileAfterSend(true);

    }

    public function companySave(Request $request)
    {
        $this->validate($request,[
            'name' =>'required',
            'nr_fiscal' =>'numeric',
            'nr_business' =>'numeric',
            'nr_tax' =>'numeric',
            'tvsh' =>'numeric|required',
            'phone' =>'required|min:9|numeric',
            'adress' =>'required|min:2',
            'email' => 'email',
            'city' =>'required|min:2',
            'account_1' =>'numeric|min:10',
            'account_2' =>'numeric|min:10',
            'account_3' =>'numeric|min:10',
            'logo' =>'image|nullable|max:1999',
        ]);

        $company =  DB::table('company')->first();
        if($request->input('theme') == 0)
            $theme = false;
        else
            $theme = true;
        if($request->hasFile('logo'))
        {
            $fileNamewithExt = $request->file('logo')->getClientOriginalName();
            $fileName = pathInfo($fileNamewithExt, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNametoStore = $company->name.'.'.$extension;
            $request->file('logo')->move(public_path('img'), $fileNametoStore);
            $add = DB::table('company')->where('id', $company->id)
            ->update(['name' =>  $request->input('name'),
                        'logo' => $fileNametoStore,
                        'theme' => $theme,
                        'nr_fiscal' => $request->input('nr_fiscal'),
                        'nr_business' => $request->input('nr_business'),
                        'nr_tax' => $request->input('nr_tax'),
                        'tvsh' => $request->input('tvsh'),
                        'phone' => $request->input('phone'),
                        'adress' => $request->input('adress'),
                        'email' => $request->input('email'),
                        'city' => $request->input('city'),
                        'account_1' => $request->input('account_1'),
                        'account_2' => $request->input('account_2'),
                        'account_3' => $request->input('account_3')]);
        }
        else
        {
            $add = DB::table('company')->where('id', $company->id)
            ->update(['name' =>  $request->input('name'),
                        'theme' => $theme,
                        'nr_fiscal' => $request->input('nr_fiscal'),
                        'nr_business' => $request->input('nr_business'),
                        'nr_tax' => $request->input('nr_tax'),
                        'tvsh' => $request->input('tvsh'),
                        'phone' => $request->input('phone'),
                        'adress' => $request->input('adress'),
                        'email' => $request->input('email'),
                        'city' => $request->input('city'),
                        'account_1' => $request->input('account_1'),
                        'account_2' => $request->input('account_2'),
                        'account_3' => $request->input('account_3')]);
        }


        return redirect('/company')->with('success',__('messages.company-edit'));

    }

    public function getNotificationsDataTable()
    {
        $notifications = Notifications::orderBy('created_at','desc');
        $table = DataTables::of($notifications)
        ->editColumn ('description','@if($opened) {{$description}} @else <p style="color:black"><b>{{$description}}</b></p> @endif')
        ->editColumn ('created_at','@if($opened) {{$created_at}} @else  <p style="color:black"><b>{{$created_at}}</b></p> @endif')
        ->rawColumns(['description','created_at'])
        ->make(true);
        return $table;

    }


    public function addToCart(Request $request)
    {

        if($request->ajax())
        {
            $discount = '-'.$request->input('discount').'%';
            $id = Cart::getContent()->count();
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Discount',
                'type' => 'discount',
                'target' => 'total',
                'value' =>  $discount,
                'order' => 1
            ));
            $cart = Cart::add(
                array(
                    'id' => ++$id,
                    'name' => $request->input('name'),
                    'price' => $request->input('price'),
                    'quantity' => $request->input('quantity'),
                    'attributes' => array(
                        'tooth' => $request->input('tooth'),
                        'discount' => $request->input('discount') ,
                        'serviceId' => $request->input('id')),
                    'conditions' => $condition
                ));
            return response()->json(['success'=>'U shtua në pagesë.']);
        }
    }


    public function deleteFromCart(Request $request)
    {
        if($request->ajax())
        {
            Cart::remove($request->input('id'));
            return response()->json(['success'=>'U largua në pagesë.']);
        }
    }

    public function markAsRead(Request $request)
    {
        if($request->ajax())
        {
            $notification = Notifications::find($request->input('id'));
            $notification->opened = true;
            $notification->save();
            return response()->json(['success'=>'U markua si e lexuar.']);
        }
    }

    public function getAppointments(Request $request)
    {
        $appointments = Appointment::whereBetween('date_of_appointment',[$request->start,$request->end])->get();
        $data[] = [];
        foreach($appointments as $appointment)
        {
            $pacient = Pacient::getPacientName($appointment->pacient_id);
            $color = User::getUserColor($appointment->user_id);
            $data[] = array(
                'title' => $appointment->time_of_appointment.' - '.$pacient,
                'start' => $appointment->appointment_date,
                'end' => $appointment->appointment_date,
                'backgroundColor' => $color,
                'borderColor' =>  $color
            );
        }
        return Response::json($data);
    }



}
