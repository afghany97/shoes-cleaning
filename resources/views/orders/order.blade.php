@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="panel panel-default">

            <div class="panel panel-heading">

                <h1>Order information</h1>

                <div class="panel-body">

                    <ul class="list-group">

                        <li class="list-group-item">

                            <strong>Order barcode: </strong> {{$order->token}}

                        </li>
                        <li class="list-group-item">

                            <strong>Customer name : </strong> {{$order->customer->name}}

                        </li>

                        <li class="list-group-item">

                            <strong>Customer mobile : </strong> {{$order->customer->mobile}}

                        </li>

                        <li class="list-group-item">

                            <strong>Shoes type: </strong> {{$order->shoes->type}}

                        </li>

                        <li class="list-group-item">

                            <strong>Order image: </strong> <img src="/storage/{{$order->image_path}}" alt="image"
                                                                class="small-image">

                        </li>

                        <li class="list-group-item">

                            <strong>Order date: </strong> {{$order->created_at->format('Y-m-d')}}

                        </li>

                        <li class="list-group-item">

                            <strong>Order time: </strong> {{$order->created_at->format('h:i:s A')}}

                        </li>

                    </ul>

                </div>

            </div>

        </div>

    </div>

@endsection