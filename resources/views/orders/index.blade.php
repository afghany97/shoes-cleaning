@extends('layouts.app'  )

@section('title')

    Orders

@endsection

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                @forelse($orders as $order)

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <a href="{{route('order.show',$order)}}">

                                {{$order->customer->name}}
                            </a>

                            <span class="pull-right">

                                    {{$order->created_at->diffForHumans()}}

                            </span>

                        </div>

                        <div class="panel-body">

                            <div class="pull-left">

                                {{$order->barcode}}

                            </div>
                            
                            <div class="pull-right">

                                <img src="{{$order->imagePath()}}" alt="" class="tiny-image">
                                
                            </div>

                        </div>

                        <div class="panel-footer">

                            <a href="{{route('order.show',$order)}}" class="btn btn-default btn-xs">Show more</a>

                        </div>

                    </div>

                @empty

                    <div class="text-center">

                        <h1>There is no orders</h1>

                    </div>

                @endforelse

                <div class="text-center">

                    {{$orders->links()}}

                </div>

            </div>

            <div class="col-md-4">

                <div class="panel panel-default">

                    <div class="panel panel-heading">

                        <strong>Sorting</strong>

                    </div>

                    <div class="panel-body">

                        <form method="GET" action="{{route('orders')}}">

                            From :

                            <input type="text" class="form-control" name="from" required placeholder="Pick from date"
                                   onfocus="this.type='date'">

                            <hr>

                            To :

                            <input type="text" name="to" class="form-control" placeholder="Pick to date"
                                   onfocus="this.type='date'">

                            <hr>

                            <button type="submit" class="btn btn-default btn-xs">search</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
