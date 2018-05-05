@extends('layouts.app'  )

@section('content')

    <div class="container">

        <div class="row">

            <div class="col-md-8">

                <div class="panel panel-default">

                    @forelse($orders as $order)


                        <div class="panel-heading">

                            <a href="{{$order->path()}}">

                                {{$order->customer->name}}
                            </a>

                        </div>

                        <div class="panel-body">

                            <div class="body">

                                {{$order->token}}

                            </div>

                        </div>

                    @empty

                        <h1>There is no orders</h1>

                    @endforelse

                </div>

            </div>


            <div class="col-md-4">

                <div class="panel panel-default">

                    <div class="panel panel-heading">

                        <strong>Sorting</strong>

                    </div>

                    <div class="panel-body">

                        <form method="GET" action="/orders">

                            From :

                            <input type="date" class="form-group-sm" name="from" required>

                            <hr>

                            To :

                            <input type="date" name="to" class="form-group-sm" required>

                            <hr>

                            <button type="submit" class="btn btn-default btn-xs">search</button>

                        </form>
                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
