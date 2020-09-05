<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Appointment;
use App\Treatment;
use App\Pacient;
use App\Report;
use App\Services;
use App\Visit;
use App\Debt;
use App\Bill;
use App\Payment;
use App\Notifications;
use DataTables;
use DB;
use Carbon\Carbon;
use Cart;
use Redirect,Response;
use Spatie\Activitylog\Models\Activity;

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
        return view('notifications');

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
        if($company == null)
        {
            $companyNew  = DB::table('company')->insert(['name' =>  'DentistCMS',
                        'logo' => 'no-logo.png',
                        'theme' => false,
                        'nr_fiscal' =>'123456789',
                        'nr_business' => '123456789',
                        'nr_tax' =>'123456789',
                        'tvsh' =>'18',
                        'phone' => '123456789',
                        'adress' =>'Rruga',
                        'email' => 'dentistCMS@gmail.com',
                        'city' => 'Prizren',
                        'account_1' =>'1234567890123456',
                        'account_2' => '1234567890123456',
                        'account_3' => '1234567890123456']);
            return redirect('/company');
        }
        else
            return view('company.company')->with('company', $company);

    }

    public function logs()
    {
        return view('logs');

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

    public function getLogsDataTable()
    {
        $activity = Activity::all();
        $table = DataTables::of($activity)
        ->editColumn ('Subjekti','@if($subject_type == "App\Appointment") Termin
                                    @elseif($subject_type == "App\Bill") Fature
                                    @elseif($subject_type == "App\Debt") Borgj
                                    @elseif($subject_type == "App\Pacient") Pacient
                                    @elseif($subject_type == "App\Payment") Pagese
                                    @elseif($subject_type == "App\Report") Raport
                                    @elseif($subject_type == "App\Role") Roli
                                    @elseif($subject_type == "App\Services") Sherbim
                                    @elseif($subject_type == "App\Treatment") Trajtim
                                    @elseif($subject_type == "App\User") Perdorues
                                    @elseif($subject_type == "App\Vizit")  Vizit
                                    @else Njoftim @endif')
        ->editColumn ('Pershkrimi','@if($description == "logged_in") Kyqja @elseif($description == "created") Shtuar @elseif($description == "updated") Ndryshuar @else Fshirë @endif')
        ->editColumn ('Perdoruesi','@if($causer_id != null)<a class="btn btn-circle btn-secondary btn-sm" href="/user/{{$causer_id}}"><i class="fa fa-user-md"></i></a> {{App\User::getUser($causer_id)}} @else Ska @endif')
        ->editColumn ('Data','{{\Carbon\Carbon::parse($created_at)->format("d/m/Y H:i:s")}}')
        ->addColumn('Info','<button type="button" class="btn btn-secondary btn-circle" data-toggle="modal" data-target="#exampleModal{{$id}}">
        <i class="fa fa-eye"></i>
      </button>

      <!-- Modal -->
      <div class="modal fade bd-example-modal-lg"  id="exampleModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel{{$id}}" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel{{$id}}">Të dhënat</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            @if($subject_type === "App\Appointment")
            <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Pacienti:</th>
                    <td scope="row">{{$properties["attributes"]["pacient.first_name"]}} {{$properties["attributes"]["pacient.last_name"]}} {{$properties["attributes"]["pacient.personal_number"]}}</td>
                </tr>
                <tr>
                    <th>Mjeku:</th>
                    <td scope="row">{{$properties["attributes"]["user.name"]}}</td>
                </tr>
                <tr>
                    <th>Data e terminit:</th>
                    <td scope="row">{{$properties["attributes"]["date_of_appointment"]}}</td>
                </tr>
                <tr>
                    <th>Ora e terminit:</th>
                    <td scope="row">{{$properties["attributes"]["time_of_appointment"]}}</td>
                </tr>
            </tbody>
            </table>
            @elseif($subject_type == "App\Bill")
            <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Subjekti:</th>
                    <td scope="row">{{$properties["attributes"]["subject"]}}</td>
                </tr>
                <tr>
                    <th>Nr i faturës:</th>
                    <td scope="row">{{$properties["attributes"]["bill_nr"]}}</td>
                </tr>
                <tr>
                    <th>Vlera:</th>
                    <td scope="row">{{$properties["attributes"]["value"]}} €</td>
                </tr>
                <tr>
                    <th>Afati:</th>
                    <td scope="row">{{$properties["attributes"]["deadline"]}}</td>
                </tr>
                <tr>
                    <th>Data:</th>
                    <td scope="row">{{$properties["attributes"]["created_at"]}}</td>
                </tr>
            </tbody>
            </table>
            @elseif($subject_type == "App\Debt")
            <table class="table table-stripped">
            <tbody>
            <tr>
                <th>Pacienti:</th>
                <td scope="row">{{$properties["attributes"]["pacient.first_name"]}} {{$properties["attributes"]["pacient.last_name"]}} {{$properties["attributes"]["pacient.personal_number"]}}</td>
            </tr>
            <tr>
                <th>Vlera:</th>
                <td scope="row">{{$properties["attributes"]["value"]}} €</td>
            </tr>
            <tr>
                <th>Afati:</th>
                <td scope="row">{{$properties["attributes"]["deadline"]}}</td>
            </tr>
            <tr>
                <th>Data:</th>
                <td scope="row">{{$properties["attributes"]["created_at"]}}</td>
            </tr>
            </tbody>
            </table>
            @elseif($subject_type == "App\Pacient")
            <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Emri:</th>
                    <td scope="row">{{$properties["attributes"]["first_name"]}}</td>
                </tr>
                <tr>
                    <th>Emri i prindit:</th>
                    <td scope="row">{{$properties["attributes"]["fathers_name"]}}</td>
                </tr>
                <tr>
                    <th>Mbiemri:</th>
                    <td scope="row">{{$properties["attributes"]["last_name"]}}</td>
                </tr>
                <tr>
                    <th>Numri Personal:</th>
                    <td scope="row">{{$properties["attributes"]["personal_number"]}}</td>
                </tr>
                <tr>
                    <th>Gjinia:</th>
                    <td scope="row">{{$properties["attributes"]["gender"]}}</td>
                </tr>
                <tr>
                    <th>Data e lindjes:</th>
                    <td scope="row">{{$properties["attributes"]["date_of_birth"]}}</td>
                </tr>
                <tr>
                    <th>Adresa:</th>
                    <td scope="row">{{$properties["attributes"]["address"]}}</td>
                </tr>
                <tr>
                    <th>Vendbanimi:</th>
                    <td scope="row">{{$properties["attributes"]["residence"]}}</td>
                </tr>
                <tr>
                    <th>Qyteti:</th>
                    <td scope="row">{{$properties["attributes"]["city"]}}</td>
                </tr>
                <tr>
                    <th>Telefoni:</th>
                    <td scope="row">{{$properties["attributes"]["phone"]}}</td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td scope="row">{{$properties["attributes"]["email"]}}</td>
                </tr>
            </tbody>
            </table>
            @elseif($subject_type == "App\Payment")
            <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Pacienti:</th>
                    <td scope="row">{{$properties["attributes"]["pacient.first_name"]}} {{$properties["attributes"]["pacient.last_name"]}} {{$properties["attributes"]["pacient.personal_number"]}}</td>
                </tr>
                <tr>
                    <th>Vlera:</th>
                    <td scope="row">{{$properties["attributes"]["value"]}}</td>
                </tr>
                <tr>
                    <th>Data:</th>
                    <td scope="row">{{$properties["attributes"]["created_at"]}}</td>
                </tr>
            </tbody>
            </table>
            @elseif($subject_type == "App\Report")
            <table class="table table-stripped">
             <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Data</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>Pacienti:</th>
                    <td scope="row">{{$properties["attributes"]["pacient.first_name"]}} {{$properties["attributes"]["pacient.last_name"]}} {{$properties["attributes"]["pacient.personal_number"]}}</td>
                </tr>
                <tr>
                    <th>Mjeku:</th>
                    <td scope="row">{{$properties["attributes"]["user.name"]}}</td>
                </tr>
                <tr>
                    <th>Rekomandimi:</th>
                    <td scope="row">{{$properties["attributes"]["recommendation"]}}</td>
                </tr>
                <tr>
                    <th>Ankesa:</th>
                    <td scope="row">{{$properties["attributes"]["complaint"]}}</td>
                </tr>
                <tr>
                    <th>Vlersimi:</th>
                    <td scope="row">{{$properties["attributes"]["evaluation"]}}</td>
                </tr>
                <tr>
                    <th>Diagnoza:</th>
                    <td scope="row">{{$properties["attributes"]["diagnosis"]}}</td>
                </tr>
                <tr>
                    <th>Data:</th>
                    <td scope="row">{{$properties["attributes"]["created_at"]}}</td>
                </tr>
            </tbody>
            </table>
            @elseif($subject_type == "App\Role")
            <table class="table table-stripped">
           <tbody>
                <tr>
                    <th>Emri:</th>
                    <td scope="row">{{$properties["attributes"]["name"]}}</td>
                </tr>
                <tr>
                    <th>Shkurtesa:</th>
                    <td scope="row">{{$properties["attributes"]["slug"]}}</td>
                </tr>
                <tr>
                    <th>Data:</th>
                    <td scope="row">{{$properties["attributes"]["created_at"]}}</td>
                </tr>
           </tbody>
           </table>
            @elseif($subject_type == "App\Services")
            <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Shërbimi:</th>
                    <td scope="row">{{$properties["attributes"]["name"]}}</td>
                </tr>
                <tr>
                    <th>Cmimi:</th>
                    <td scope="row">{{$properties["attributes"]["price"]}}</td>
                </tr>
                <tr>
                    <th>Zbritja:</th>
                    <td scope="row">{{$properties["attributes"]["discount"]}}</td>
                </tr>
                <tr>
                    <th>Data:</th>
                    <td scope="row">{{$properties["attributes"]["created_at"]}} </td>
                </tr>
            </tbody>
            </table>
            @elseif($subject_type == "App\Treatment")
            <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Pacienti:</th>
                    <td scope="row">{{$properties["attributes"]["pacient.first_name"]}} {{$properties["attributes"]["pacient.last_name"]}} {{$properties["attributes"]["pacient.personal_number"]}}</td>
                </tr>
                <tr>
                    <th>Data e fillimit</th>
                    <td scope="row">{{$properties["attributes"]["starting_date"]}}</td>
                </tr>
                <tr>
                    <th>Kohëzgjatja:</th>
                    <td scope="row">{{$properties["attributes"]["duration"]}}</td>
                </tr>
                <tr>
                    <th>Data:</th>
                    <td scope="row">{{$properties["attributes"]["created_at"]}}</td>
                </tr>
            </tbody>
            </table>
            @elseif($subject_type == "App\User")
            @if($description == "logged_in")
                <table class="table table-stripped">
                <tbody>
                    <tr>
                        <th>Kyqja:</th>
                        <td scope="row">{{$created_at}} </td>
                    </tr>
                    </tbody>
                </table>
            @else
            <table class="table table-stripped">
            <tbody>
            <tr>
                <th>Emri dhe Mbiemri:</th>
                <td scope="row">{{$properties["attributes"]["name"]}}</td>
            </tr>
            <tr>
                <th>E-mail:</th>
                <td scope="row">{{$properties["attributes"]["email"]}}</td>
            </tr>
            <tr>
                <th>Roli:</th>
                <td scope="row">{{$properties["attributes"]["role.name"]}}</td>
            </tr>
            <tr>
                <th>Ngjyra:</th>
                <td scope="row"><div class="p-2 w-50" style="background-color:{{$properties["attributes"]["color"]}};"></div></td>
            </tr>
            <tr>
                <th>Data:</th>
                <td scope="row">{{$properties["attributes"]["created_at"]}}</td>
            </tr>
            </tbody>
            </table>
            @endif
            @elseif($subject_type == "App\Visit")
            <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Pacienti:</th>
                    <td scope="row">{{$properties["attributes"]["pacient.first_name"]}} {{$properties["attributes"]["pacient.last_name"]}} {{$properties["attributes"]["pacient.personal_number"]}}</td>
                </tr>
                <tr>
                    <th>Dentisti:</th>
                    <td scope="row">{{$properties["attributes"]["user.name"]}}</td>
                </tr>
                <tr>
                    <th>Data e vizitës:</th>
                    <td scope="row">{{$properties["attributes"]["date_of_visit"]}}</td>
                </tr>
                <tr>
                    <th>Ora e vizitës:</th>
                    <td scope="row">{{$properties["attributes"]["time_of_visit"]}}</td>
                </tr>
            </tbody>
            </table>

            @else
            <table class="table table-stripped">
            <tbody>
                <tr>
                    <th>Pershkrimi:</th>
                    <td scope="row">{{$properties["attributes"]["description"]}}</td>
                </tr>
                <tr>
                    <th>Tipi:</th>
                    <td scope="row">{{$properties["attributes"]["type"]}}</td>
                </tr>
                <tr>
                    <th>Data:</th>
                    <td scope="row">{{$properties["attributes"]["date"]}} </td>
                </tr>
            </tbody>
            </table>
            @endif
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"> </i></button>

            </div>
          </div>
        </div>
      </div>

       ')
        ->rawColumns(['Subjekti','Pershkrimi','Perdoruesi','Info'])
        ->make(true);
        return $table;

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
                'start' => $appointment->date_of_appointment,
                'end' => $appointment->date_of_appointment,
                'backgroundColor' => $color,
                'borderColor' =>  $color
            );
        }
        return Response::json($data);
    }



}
