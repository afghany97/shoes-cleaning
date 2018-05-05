@extends('layouts.app'  )

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                @forelse($orders as $order)

                    <div class="panel panel-default">

                        <div class="panel-heading">

                            <a href="{{$order->path()}}">

                                {{$order->customer->name}}

                                <hr>

                            </a>

                        </div>


                        @empty

                            <h1>There is no orders</h1>

                        @endforelse

                    </div>

            </div>

        </div>

    </div>

@endsection
