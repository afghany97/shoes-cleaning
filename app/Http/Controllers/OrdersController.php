<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Events\OrderCreated;
use App\Filters\OrdersFilter;
use App\Http\Requests\OrdersFormRequest;
use App\Locker;
use App\Order;
use App\Services\Export\ExcelGenerator;
use App\Services\Export\PdfGenerator;
use App\Shoe;

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
        $orders = Order::priority()->filter($filters);

        $orders = $orders->paginate(10);

        $shoes = Shoe::all();

        $isThereFreeCompletedLocker = !!Locker::undeleted()->free()->completed()->count();

        return view('orders.index', compact('orders', 'shoes', 'isThereFreeCompletedLocker'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shoes = Shoe::all();

        $isThereFreeLocker = !!Locker::undeleted()->free()->progress()->count();

        return view('orders.create', compact('shoes', 'isThereFreeLocker'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrdersFormRequest $formRequest
     * @return \Illuminate\Http\Response
     */
    public function store(OrdersFormRequest $formRequest)
    {
        $customer = Customer::fetchOrCreate();

        $order = order::createOrder($customer);

        if(request()->file('images')){

            foreach (request()->file('images') as $image){

                $order->image($image->store('images/orders','public'));
            }
        }

        event(new OrderCreated($order));

        return ($customer && $order) ?

            redirect(route('order.show', $order))->withSuccess('Order created successfully') :

            back()->withErrors('Create Order Fails');
    }

    public function complete(Order $order)
    {
        // convert this logic to event like ordercreated

        if ($order->locker) {

            $order->locker->removeShoe()->setFree();

            $order->removeLocker();
        }

        $order->complete()->moveToCompletedLocker();

        return redirect(route('order.show', $order))->withSuccess('order completed successfully');
    }

    public function delivered(Order $order)
    {
        // convert this logic to event like ordercreated

        if ($order->locker) {
            $order->locker->removeShoe()->setFree();

            $order->removeLocker();
        }

        $order->delivered();

        return redirect(route('orders'))->withSuccess('order delivered successfully');
    }

    public function exportToPdf(Order $order, PdfGenerator $pdfGenerator)
    {
        $html = view('export.orderToPdf', compact('order'))->render();

        return $pdfGenerator->setData($html)->setFilename($order->getPdfFileName())->generate() ?

            redirect()->route('orders')->withSuccess('PDF generated successfully') :

            redirect()->route('orders')->withErrors('failed generate PDF');
    }

    public function exportToExcel(ExcelGenerator $excel)
    {
        $orders = Order::all()->load(['customer', 'shoe'])->toArray();

        $data = array_map(function ($order) {
            return [
                'id' => $order['id'],
                'customer name' => $order['customer']['name'],
                'customer mobile' => $order['customer']['mobile'],
                'customer address' => $order['customer']['address'],
                'price' => $order['price'],
                'shoe type' => $order['shoe']['type'],
                'status' => $order['status'],
                'created date' => $order['created_at'],
                'delivery_date' => $order['delivery_date']
            ];
        }, $orders);

        return $excel->setData(collect($data))->generate() ?

            redirect()->route('orders')->withSuccess('Excel file exported successfully') :

            redirect()->route('orders')->withErrors('Failed export Excel file ');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\order $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\order $order
     * @return \Illuminate\Http\Response
     */
    public function update(order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
