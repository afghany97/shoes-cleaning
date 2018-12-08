@extends('layouts.app')

@section('title')

    Order {{$order->id}}

@endsection

@section('content')

    <order-page inline-template>

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

                                <strong>Shoes type: </strong> {{$order->shoe->type}}

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

                                <strong>Priority: </strong> {{array_search($order->priority,config('order.priority'))}}

                            </li>

                            <li class="list-group-item">

                                <strong>Note: </strong> {{$order->note}}

                            </li>

                            <li class="list-group-item">

                                <strong>price: </strong> {{$order->price}}

                            </li>

                            <li class="list-group-item">

                                <strong>status: </strong> {{$order->status}}

                            </li>

                            @if($order->hasBeforeImages())

                                <li class="list-group-item">

                                    <strong>Before Images: </strong>

                                    @foreach($order->media()->images()->before()->get() as $image)

                                        <img src="{{$image->fullPath()}}" alt="image" class="small-image"
                                             width="{{ 85 / $order->media()->images()->count()}}%" @click="showModal()">

                                    @endforeach

                                </li>

                            @endif

                            @if($order->hasAfterImages())

                                <li class="list-group-item">

                                    <strong>After images: </strong>

                                    @foreach($order->media()->images()->after()->get() as $image)

                                        <img src="{{$image->fullPath()}}" alt="image" class="small-image"
                                             width="{{ 85 / $order->media()->images()->count()}}%">

                                    @endforeach

                                </li>

                            @endif

                            @if($order->hasVideos())

                                <li class="list-group-item">

                                    <strong>Order Videos: </strong>

                                    @foreach($order->media()->videos()->get() as $video)

                                        <video width="{{ 85 / $order->media()->videos()->count()}}%" controls
                                               class="small-image">

                                            <source src="{{$video->fullPath()}}"
                                                    type="video/{{$video->getFileExtension()}}">

                                            Your browser does not support HTML5 video.

                                        </video>

                                    @endforeach

                                </li>

                            @endif

                            <li class="list-group-item">

                                <strong>Order date: </strong> {{$order->created_at->format('Y-m-d')}}

                            </li>

                            <li class="list-group-item">

                                <strong>Order time: </strong> {{$order->created_at->format('h:i:s A')}}

                            </li>

                            <li class="list-group-item">

                                <strong>delivery date
                                    :</strong> {{\Carbon\Carbon::parse($order->delivery_date)->format('Y-m-d')}}

                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </order-page>

@if($order->sensitive)

@section('js')

    <script src="{{url('js/Order.js')}}"></script>

@endsection

@endif

@endsection