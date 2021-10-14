<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Http;

class OrderController extends Controller
{

    public function index()
    {

        $orders = Order::query()->where('user_id', auth()->user()->id);

        if(request('status')){
            $orders->where('status', request('status'));
        }

        $orders = $orders->get();

        $pendiente  = Order::where('status', 1)->where('user_id', auth()->user()->id)->count();
        $reciido    = Order::where('status', 2)->where('user_id', auth()->user()->id)->count();
        $enviado    = Order::where('status', 3)->where('user_id', auth()->user()->id)->count();
        $entragado  = Order::where('status', 4)->where('user_id', auth()->user()->id)->count();
        $anulado    = Order::where('status', 5)->where('user_id', auth()->user()->id)->count();

        return view('orders.index', compact('orders', 'pendiente','reciido','enviado','entragado','anulado'));
    }
    public function show(Order $order){


        //Utilizar policy
        $this->authorize('author', $order);

        $items = json_decode($order->content);
        return view('orders.show', compact('order', 'items'));

    }

    /* public function payment(Order $order){

        $items = json_decode($order->content);

        return view('orders.payment', compact('order','items'));
    } */

    public function pay(Order $order, Request $request){

        //Utilizar policy
        $this->authorize('author', $order);

        $payment_id = $request->get('payment_id');

        $response = Http::get("https://api.mercadopago.com/v1/payments/{$payment_id}" . "?access_token=APP_USR-1017015032028233-072206-fc68cbe7c5b532b2ff8dfb85a4fedab4-795221046");
        
        $response = json_decode($response);

        $status = $response->status;

        if($status == 'approved'){
            $order->status = 2;
            $order->save();

           
        }

        return redirect()->route('orders.show', $order);

    }
}
