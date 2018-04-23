@extends('layouts.app')

@section('content')

    <div class="container">

        <div class="panel panel-default">

            <div class="panel panel-heading">

                <h1>Order information</h1>

                <div class="panel-body">

                    <ul class="list-group">

                        <li class="list-group-item">

                            <strong>Customer name : </strong> {{$order->user->name}}

                        </li>

                        <li class="list-group-item">

                            <strong>Customer mobile : </strong> {{$order->user->mobile}}

                        </li>

                        <li class="list-group-item">

                            <strong>Shoes type: </strong> {{\App\shoes::find($order->shoes_id)->type}}

                        </li>

                        <li class="list-group-item">

                            <strong>Order image: </strong> <img src="/storage/{{$order->image_path}}" alt="image"
                                                                class="small-image">

                        </li>
                    </ul>

                </div>

            </div>

        </div>

    </div>

@endsection