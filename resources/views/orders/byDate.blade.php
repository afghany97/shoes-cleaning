@extends('layouts.app'  )

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <table border="1">

                    <tr>

                        <th>barcode</th>

                        <th>name</th>

                        <th>mobile</th>

                        <th>address</th>

                        <th>shoes type</th>

                        <th>created date</th>

                        <th>delivery date</th>

                    </tr>

                    @foreach($orders as $order)

                        <tr>

                            <td>{{$order->token}}</td>

                            <td>{{$order->customer->name}}</td>

                            <td>{{$order->customer->mobile}}</td>

                            <td>{{$order->customer->address}}</td>

                            <td>{{$order->shoes->type}}</td>

                            <td>{{$order->created_at->format('Y-m-d')}}</td>

                            <td>{{Carbon\Carbon::parse($order->delivery_date)->format('Y-m-d')}}</td>

                        </tr>


                    @endforeach

                </table>

            </div>

        </div>

    </div>

@endsection
