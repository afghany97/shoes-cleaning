@extends('layouts.export')

@section('content')

        <table border="1">

            <tr>

                <th>ID</th>

                <th>Customer Name</th>

                <th>Customer Mobile</th>

                <th>Customer Address</th>

                <th>Price</th>

                <th>Status</th>

                <th>Shoe Type</th>

                <th>Note</th>

                <th>Created Date</th>

                <th>Delivered Date</th>

            </tr>

            <tr>

                <th>{{$order->id}}</th>

                <th>{{$order->customer->name}}</th>

                <th>{{$order->customer->mobile}}</th>

                <th>{{$order->customer->address}}</th>

                <th>{{$order->price}}</th>

                <th>{{$order->status}}</th>

                <th>{{$order->shoe->type}}</th>

                <th>{{$order->note}}</th>

                <th>{{$order->created_at->format('Y-m-d H:i:s')}}</th>

                <th>{{$order->delivery_date}}</th>

            </tr>

        </table>

@endsection