@extends('layouts.app')

@section('title')

    Order {{$order->id}}

@endsection

@section('content')

    <div class="container">

        <div class="panel panel-default">

            <div class="panel panel-heading">

                <h1>Order information</h1>

                <div class="panel-body">

                    <ul class="list-group">

                        <li class="list-group-item">

                            <strong>Order barcode: </strong> {{$order->barcode}}

                        </li>

                        <li class="list-group-item">

                            <strong>Customer name : </strong> {{$order->customer->name}}

                        </li>

                        <li class="list-group-item">

                            <strong>Customer mobile : </strong> {{$order->customer->mobile}}

                        </li>

                        <li class="list-group-item">

                            <strong>Customer address : </strong> {{$order->customer->address}}

                        </li>

                        <li class="list-group-item">

                            <strong>Shoes type: </strong> {{$order->shoes->type}}

                        </li>

                        @if($order->status != config('order.status.delivered') && !$order->locker)

                            <li class="list-group-item">

                                <strong>Locker Number: </strong> Order has no locker

                            </li>

                        @endif

                        @if($order->status != config('order.status.delivered') && $order->locker)

                            <li class="list-group-item">

                                <strong>Locker Number: </strong> {{$order->locker->number}}

                            </li>

                        @endif

                        <li class="list-group-item">

                            <strong>Note: </strong> {{$order->note}}

                        </li>

                        <li class="list-group-item">

                            <strong>price: </strong> {{$order->price}}

                        </li>

                        <li class="list-group-item">

                            <strong>status: </strong> {{$order->status}}

                        </li>

                        <li class="list-group-item">

                            <strong>Order image: </strong> <img src="{{$order->imagePath()}}" alt="image"
                                                                class="small-image">

                        </li>

                        <li class="list-group-item">

                            <strong>Order date: </strong> {{$order->created_at->format('Y-m-d')}}

                        </li>

                        <li class="list-group-item">

                            <strong>Order time: </strong> {{$order->created_at->format('h:i:s A')}}

                        </li>

                        <li class="list-group-item">

                            <strong>delivery date :</strong> {{\Carbon\Carbon::parse($order->delivery_date)->format('Y-m-d')}}

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

@if($order->sensitive)

    @section('js')

        <script src="{{url('js/Order.js')}}"></script>

    @endsection

@endif

@endsection