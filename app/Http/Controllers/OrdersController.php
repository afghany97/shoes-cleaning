<?php

namespace App\Http\Controllers;

use App\customer;
use App\Http\Requests\OrdersFormRequest;
use App\order;
use App\shoes;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * OrdersController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->has('from') || request()->has('to'))
        {
            $orders = Order::where('created_at' , '>=' , request('from'))
                ->where('created_at' , '<=' , request('to'))->get();

            return view('orders.byDate',compact('orders'));

        }
        $orders = Order::all();

        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoess = shoes::all();

        return view('orders.create' , compact('shoess'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(OrdersFormRequest $formRequest)
    {
        $customer = customer::fetch();

        $order = order::addOrder($customer);

        return redirect($order->path());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        return view('orders.order',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
