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

                            <strong>Shoes</strong> :

                            <br>

                            <ol>

                                @foreach($order->shoes as $shoe)

                                    <li>{{$shoe->type}}</li>

                                @endforeach

                            </ol>

                        </li>

                        <li class="list-group-item">

                            <strong>price: </strong> {{$order->price}}

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

@endsection