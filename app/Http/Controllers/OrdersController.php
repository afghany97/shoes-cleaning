<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Filters\OrdersFilter;
use App\Http\Requests\OrdersFormRequest;
use App\Order;
use App\Shoes;
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
     * @param OrdersFilter $filters
     * @return \Illuminate\Http\Response
     */
    public function index(OrdersFilter $filters)
    {
        $orders = Order::latest()->Filter($filters);

        $orders = $orders->paginate(10);

        return view('orders.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoes = shoes::all();

        return view('orders.create' , compact('shoes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrdersFormRequest $formRequest
     * @return \Illuminate\Http\Response
     */
    public function store(OrdersFormRequest $formRequest)
    {
        $customer = customer::fetchOrCreate();

        $order = order::createOrder($customer);

        return redirect(route('order.show',$order));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        return view('orders.show',compact('order'));
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
