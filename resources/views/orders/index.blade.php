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

                            @if($order->hasBeforeImages())

                                <div class="pull-right">

                                    <img src="{{$order->media()->images()->first()->fullPath()}}" alt=""
                                         class="tiny-image">

                                </div>

                            @endif

                        </div>

                        <div class="panel-footer">

                            <a href="{{route('order.show',$order)}}" class="btn btn-default btn-xs">Show more</a>

                            <a href="{{route('order.export.pdf',$order)}}" class="btn btn-default btn-xs">Export PDF</a>

                            @if($order->status != config('order.status.delivered'))

                                <a href="{{route('order.edit',$order)}}" class="btn btn-primary btn-xs">Edit Order</a>

                            @endif

                            @if($order->status == config('order.status.progress'))

                                <a href="{{route('order.complete',$order)}}" class="btn btn-success btn-xs pull-right"
                                   onclick="{{$isThereFreeCompletedLocker ? "" : "return confirm('there is no free lockers to move to , are you want to complete the operation?')"}}">Complete</a>

                            @endif

                            @if($order->status == config('order.status.completed'))

                                <a href="{{route('order.deliver',$order)}}" class="btn btn-primary btn-xs pull-right">Deliver</a>

                            @endif

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

                            <div class="form-group">

                                From :

                                <input type="text" class="form-control" name="from" placeholder="Pick from date"
                                       onfocus="this.type='date'">

                            </div>

                            <hr>

                            <div class="form-group">

                                To :

                                <input type="text" name="to" class="form-control" placeholder="Pick to date"
                                       onfocus="this.type='date'">

                            </div>

                            <hr>

                            <div class="form-group">

                                <select name="status" class="form-control">

                                    <option selected disabled>Choose order status</option>

                                    @foreach(config('order.status') as $stats)

                                        <option value="{{$stats}}">{{$stats}}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">

                                <input class="form-control" type="text" name="name"
                                       placeholder="please enter customer name">

                            </div>

                            <div class="form-group">

                                <input class="form-control" type="number" name="mobile"
                                       placeholder="please enter customer mobile">

                            </div>

                            <div class="form-group">

                                <select name="shoe" class="form-control">

                                    <option selected disabled>Choose shoe type</option>

                                    @foreach($shoes as $shoe)

                                        <option value="{{$shoe->type}}">{{$shoe->type}}</option>

                                    @endforeach

                                </select>

                            </div>

                            <div class="form-group">

                                <input class="form-control" type="text" name="delivery" placeholder="pick delivery date"
                                       onfocus="(this.type = 'date')">

                            </div>

                            <div class="form-group">

                                <label>

                                    <input type="checkbox" name="sensitive" value="1"> Sensitive

                                </label>

                            </div>


                            <button type="submit" class="btn btn-default btn-xs">search</button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
