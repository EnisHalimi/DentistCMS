<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment;
use App\Pacient;
use App\Services;
use DataTables;
use Cart;
use PDF;

class PaymentController extends Controller
{


    public function getPaymentDataTable()
    {
        $payment = Payment::all();
        $table = DataTables::of($payment)
        ->addColumn('Menaxhimi' ,'<a href="/payment/{{$id}}" class="btn btn-circle btn-secondary "><i class="fa fa-eye"></i></a>
        <a href="/payment/{{$id}}/edit"  class="btn btn-circle btn-primary "><i class="fa fa-pen"></i></a>
        <button class="btn btn-circle btn-danger " data-toggle="modal" data-target="#fshijModal{{$id}}"><i class="fa fa-trash"></i></button>
        <div class="modal fade" id="fshijModal{{$id}}" tabindex="-1" role="dialog" aria-labelledby="fshijModalLabel{{$id}}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fshijModalLabel{{$id}}">Fshij Pagesën</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    A jeni i sigurtë që doni të vazhdoni?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-circle btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i></button>
                    <form class="d-inline" method="POST" action="{{ route(\'payment.destroy\',$id)}}" accept-charset="UTF-8">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">
                        <button type="submit" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></button>
                    </form>

                </div>
            </div>
        </div>
    </div> ')
        ->editColumn('created_at','{{\Carbon\Carbon::parse($created_at)->format("d/m/Y H:i:s")}}')
        ->editColumn('value','{{$value}} €')
        ->editColumn('pacient_id','<a class="btn btn-circle btn-secondary btn-sm" href="/pacient/{{$pacient_id}}"><i class="fa fa-user"></i></a>  {{App\Pacient::getPacientName($pacient_id)}}')
        ->rawColumns(['Menaxhimi','pacient_id'])
        ->make(true);
        return $table;
    }


    public function fatura(Request $request)
    {
        $payment = Payment::find($request->input('id'));
        $pacient = Pacient::find($payment->pacient_id);
        $data['pacient'] = $pacient;
        $data['payment'] = $payment;
        $pdf = PDF::loadView('payment.fatura', $data);
        return $pdf->stream('Fatura-'.$payment->id.'.pdf');
       }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasPermission('view-payment'))
            return view('payment.payment');
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
        $items = Cart::getContent();
        $services = Services::all();
        if(auth()->user()->hasPermission('create-payment'))
            return view('payment.create')->with('services',$services)->with('items',$items);
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
        if(auth()->user()->hasPermission('create-payment'))
        {
            $this->validate($request,[
                'pacient-id'=> 'required|numeric',
            ]);
            $payment = new Payment;
            $payment->pacient_id = $request->input('pacient-id');
            $payment->value = Cart::getTotal();
            $payment->save();
            $items = Cart::getContent();
            foreach($items as $item)
            {
                $id = $item->attributes->serviceId;
                $discount = $item->attributes->discount;
                $tooth = $item->attributes->tooth;
                $quantity = $item->quantity;
                $payment->services()->attach($id,['tooth' => $tooth, 'discount' => $discount, 'quantity' => $quantity]);
            }
            Cart::clear();
            return redirect()->action(
                'PaymentController@fatura', ['id' => $payment->id]
            );
        }
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);
        $pacient = Pacient::find($payment->pacient_id);
        if(auth()->user()->hasPermission('view-payment'))
            return view('payment.show')->with('pacient',$pacient)->with('payment',$payment);
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
        $payment = Payment::find($id);
        $services= $payment->services()->get();
        Cart::clear();
        foreach($services as $service)
        {
            $discount = '-'.$service->pivot->discount.'%';
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
                    'name' => $service->name,
                    'price' => $service->price,
                    'quantity' => $service->pivot->quantity,
                    'attributes' => array(
                        'tooth' => $service->pivot->tooth,
                        'discount' => $service->pivot->discount,
                        'serviceId' => $service->id),
                    'conditions' => $condition
                ));
        }
        $pacient = Pacient::find($payment->pacient_id);
        $items = Cart::getContent();
        if(auth()->user()->hasPermission('edit-payment'))
            return view('payment.edit')->with('pacient',$pacient)->with('payment',$payment)->with('items',$items);
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
        if(auth()->user()->hasPermission('edit-payment'))
        {
            $this->validate($request,[
                'pacient-id'=> 'required|numeric',
            ]);
            $payment = Payment::find($id);
            $payment->pacient_id = $request->input('pacient-id');
            $payment->value = Cart::getTotal();
            $payment->services()->detach();
            $payment->save();
            $items = Cart::getContent();
            foreach($items as $item)
            {
                $id = $item->attributes->serviceId;
                $discount = $item->attributes->discount;
                $tooth = $item->attributes->tooth;
                $quantity = $item->quantity;
                $payment->services()->attach($id,['tooth' => $tooth, 'discount' => $discount, 'quantity' => $quantity]);
            }
            Cart::clear();
            return redirect()->action(
                'PaymentController@fatura', ['id' => $payment->id]
            );
        }
        else
            return redirect('/')->with('error', __('messages.noauthorization'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $payment = Payment::find($id);
        if(auth()->user()->hasPermission('delete-payment'))
        {
            $payment->services()->detach();
            $payment->delete();
            return redirect('/payment')->with('success',__('messages.payment-delete'));

        }
        else
        {
            return redirect('/')->with('error',__('messages.noauthorization'));
        }
    }
}
